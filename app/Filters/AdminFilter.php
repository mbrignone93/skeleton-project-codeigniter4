<?php

    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;

    class AdminFilter implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            $session = session();

            if (!$session->get('usuario'))
                return redirect()->to(base_url('/'));
            else
            {
                if ($session->get('id_rol') != '1')
                    return redirect()->to(base_url('/error/403'));
            }
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
    }