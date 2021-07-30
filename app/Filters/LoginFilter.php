<?php

    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;

    class LoginFilter implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            $session = session();
            
            if ($session->get('usuario'))
                return redirect()->to(base_url('/menu'));
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
    }