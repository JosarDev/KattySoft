<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Usuario;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LoginController extends BaseController
{
    protected $reglas, $usuarios, $session;
    public function __construct()
    {
        $this->usuarios = new Usuario();
        $this->session = session();
    }

    public function validar()
    {
        $this->reglas = [
            'correo' => [
                'rules' => 'required|valid_email'
            ],
            'clave' => [
                'rules' => 'required'
            ]
        ];

        if ($this->request->is('post') && $this->validate($this->reglas)) {
            //REALIZAR CONSULTA A LA TABLA USUARIOS
            $data = $this->usuarios->where('correo', $this->request->getPost('correo'))->first();
            if ($data != null) {
                if (password_verify($this->request->getVar('clave'), $data['clave'])) {
                    $this->session->set([
                        'user_id' => $data['user_id'],
                        'correo' => $data['correo'],
                        'nombre' => $data['nombre'] . ' ' . $data['apellido'],
                        'rol' => $data['rol'],
                        'avatar' => $data['avatar'],
                    ]);
                    return redirect()->to('/admin')->with('respuesta', [
                        'type' => 'success',
                        'msg' => 'INICIADO SESIÓN CORRECTAMENTE'
                    ]);
                } else {
                    return redirect()->to('/')->with('respuesta', [
                        'type' => 'warning',
                        'msg' => 'CONTRASEÑA INCORRECTA'
                    ]);
                }
            } else {
                return redirect()->to('/')->with('respuesta', [
                    'type' => 'warning',
                    'msg' => 'CORREO NO EXISTE'
                ]);
            }
        } else {
            $data['validator'] = $this->validator;
            return view('index', $data);
        }
    }

    public function forgot()
    {
        return view('usuarios/forgot');
    }

    public function reset()
    {
        $this->reglas = [
            'correo' => [
                'rules' => 'required|valid_email'
            ]
        ];
        if ($this->request->is('post') && $this->validate($this->reglas)) {
            //COMPROBAR SI EXISTE EL CORREO
            $consulta = $this->usuarios->where('correo', $this->request->getPost('correo'))
                ->first();
            if ($consulta != null) {
                $fecha = date('YmdHis');
                $token = md5($fecha);
                $data = $this->usuarios->update($consulta['user_id'], ['token' => $token]);
                if ($data) {
                    $mail = new PHPMailer(true);
                    try {
                        //Server settings
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'vidainformatico.as@gmail.com';                     //SMTP username
                        $mail->Password   = 'cqjxxbmpsbaiwxsb';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('vidainformatico.as@gmail.com', 'Angel Sifuentes');
                        $mail->addAddress($consulta['correo'], $consulta['nombre']);     //Add a recipient

                        //Content
                        $mail->isHTML(true);
                        $mail->CharSet = "UTF-8";
                        $mail->Subject = 'Restablecer Clave';
                        $mail->Body    = 'Has pedido restablecer tu clave, si no has sido tú, 
                    omite este mensaje <br> <a href="' . base_url('restablecer/' . $token) . '">CLIC AQUI PARA CAMBIAR</a>';

                        $mail->send();
                        return redirect()->to('/forgot')->with('respuesta', [
                            'type' => 'success',
                            'msg' => 'CORREO ENVIADO'
                        ]);
                    } catch (Exception $e) {
                        return redirect()->to('/forgot')->with('respuesta', [
                            'type' => 'danger',
                            'msg' => 'ERROR AL ENVIAR CORREO. ' . $mail->ErrorInfo
                        ]);
                    }
                }else{
                    return redirect()->to('/forgot')->with('respuesta', [
                        'type' => 'danger',
                        'msg' => 'ERROR AL INSERTAR TOKEN'
                    ]);
                }
            } else {
                return redirect()->to('/forgot')->with('respuesta', [
                    'type' => 'warning',
                    'msg' => 'CORREO NO EXISTE'
                ]);
            }
        } else {
            $data['validator'] = $this->validator;
            return view('usuarios/forgot', $data);
        }
    }

    public function restablecer($token)
    {
        //VALIDAR TOKEN
        $data['usuario'] = $this->usuarios->where('token', $token)->first();
        if ($data['usuario'] != null) {
            return view('usuarios/restablecer', $data);
        }else{
            return redirect()->to('/')->with('respuesta', [
                'type' => 'danger',
                'msg' => 'TOKEN DESCONOCIDO'
            ]);
        }
        
    }

    public function updateClave() {
        $this->reglas = [
            'token' => [
                'rules' => 'required'
            ],
            'nueva' => [
                'rules' => 'required|max_length[255]|min_length[6]'
            ],
            'confirmar' => [
                'rules' => 'required|max_length[255]|matches[nueva]'
            ]
        ];
        $token = $this->request->getVar('token');
        if ($this->request->getMethod() == 'PUT' && $this->validate($this->reglas)) {
            $nueva = $this->request->getVar('nueva');
            $consulta = $this->usuarios->where('token', $token)->first();
            if($consulta != null){
                $data = $this->usuarios->update($consulta['user_id'], [
                    'token' => null,
                    'clave' => password_hash($nueva, PASSWORD_DEFAULT)
                ]);
                if ($data) {
                    return redirect()->to('/')->with('respuesta', [
                        'type' => 'success',
                        'msg' => 'CONTRASEÑA RESTABLECIDA'
                    ]);
                }
                return redirect()->to('/')->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'ERROR AL RESTABLECER'
                ]);
            }else{
                return redirect()->to('/perfil')->with('respuesta', [
                    'type' => 'danger',
                    'msg' => 'TOKEN ALTERADO'
                ]);
            }
            
        } else {
            $data['validator'] = $this->validator;
            $data['usuario'] = $this->usuarios->where('token', $token)->first();
            return view('usuarios/restablecer', $data);
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }
}
