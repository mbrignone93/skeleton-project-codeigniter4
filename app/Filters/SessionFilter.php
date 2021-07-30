<?php

    namespace App\Filters;

    use CodeIgniter\HTTP\RequestInterface;
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\Filters\FilterInterface;

    class SessionFilter implements FilterInterface
    {
        public function before(RequestInterface $request, $arguments = null)
        {
            $session = session();
            
            if (!$session->get('usuario'))
                return redirect()->to(base_url('/'));
        }

        public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){}
    }