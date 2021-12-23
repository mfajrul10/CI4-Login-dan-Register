<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login Page'
        ];
        return view('pages/login', $data);
    }

    public function login()
    {
        $session = session();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $this->userModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'photo' => $data['photo'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);
                return redirect()->to('/user');
            } else {
                $session->setFlashdata('error', 'Wrong password');
                return redirect()->to('/auth');
            }
        } else {
            $session->setFlashdata('error', 'Email is not registered');
            return redirect()->to('/auth');
        }
    }

    public function register()
    {
        // session();
        $data = [
            'title' => 'Register Page',
            'validation' => \Config\Services::validation()
        ];
        return view('pages/register', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} is required'
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[tb_user.email]',
                'errors' => [
                    'required' => '{field} is required',
                    'is_unique' => 'This {field} is already registered'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => '{field} is required',
                    'min_length' => 'Minimum {field} 8 character'
                ]
            ],
            'photo' => [
                'rules' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Image size is too big',
                    'is_image' => 'The file you choose is not an image',
                    'mime_in' => 'File extension not allowed'
                ]
            ],
        ])) {

            return redirect()->to('/auth/register')->withInput();
        }
        //    ambil gambar
        $filePhoto = $this->request->getFile('photo');
        // generate nama photo random
        $namaPhoto = $filePhoto->getRandomName();
        // apakah tidak ada gambar yang diupload
        if ($filePhoto->getError() == 4) {
            $namaPhoto = 'default.png';
        } else {
            //    pindahkan file ke folder img
            $filePhoto->move('img', $namaPhoto);
            // ambil nama file
            $namaPhoto = $filePhoto->getName();
        }
        $this->userModel->save([
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'photo' => $namaPhoto
        ]);

        session()->setFlashdata('success', 'Your account has been registered, Please login');

        return redirect()->to('/auth');
    }

    public function logout()
    {
        $userData = [
            'name',
            'email',
            'isLoggedIn'
        ];
        session()->remove($userData);
        session()->setFlashdata('success', 'You have been logout');
        return redirect()->to('/auth');
    }

    public function forgotpassword()
    {
        $data = [
            'title' => 'Forgot Password'
        ];
        return view('pages/forgot', $data);
    }

    function sendMail()
    {
        // link
        $to = $this->request->getVar('email');
        $data = $this->userModel->where('email', $to)->first();

        $id = $data['id'];
        if ($data) {
            $email = \Config\Services::email();

            $email->setTo($to);
            $email->setFrom('ciapp5678@gmail.com', 'Reset Password');
            $email->setSubject('Reset Password');
            $email->setMessage('Hi ' . $data['name'] . ' === '
                . '<a href="' . base_url() . '/auth/resetpassword/' . $id . '"> click here to reset password</a>');

            if ($email->send()) {
                session()->setFlashdata('success', 'Reset password send to your account, check your email or check your spam');
                return redirect()->to('/auth/forgotpassword');
            } else {
                session()->setFlashdata('error', 'your password failed to update, please try again');
                return redirect()->to('/auth/forgotpassword');
            }
        } else {
            session()->setFlashdata('error', 'Email does not exists');
            return redirect()->to('/auth/forgotpassword');
        }
    }

    public function resetpassword($id)
    {
        $data = [
            'title' => 'Reset Password',
            'akun' => $this->userModel->getAkun($id)
        ];
        return view('pages/reset', $data);
    }

    // update user data
    public function updatepassword($id)
    {
        $rules = [
            'password' => [
                'rules' => 'required|min_length[8]|max_length[50]',
                'errors' => [
                    'required' => '{field} is required',
                    'min_length' => 'Minimum {field} 8 character'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $data = [
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $this->userModel->update($id, $data);
            session()->setFlashdata('success', 'Your password has been updated, please login');
            return redirect()->to('/auth');
        } else {
            session()->setFlashdata('error', 'fail, please try again');
            return redirect()->to('/auth');
        }
    }
}
