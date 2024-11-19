<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    protected $messages = [];

    protected $title = "Ma Page";
    protected $title_prefix = "Learn-Ci";

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;

    protected $start_session = true;

    protected $require_auth = true;
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        if ($this->start_session){
            $this->start_session = session();
            if (session()->has('messages')){
                $this->messages = session()->getFlashdata('messages');
            }
    }
        $this->router = service('router');

        if($this->require_auth) {
            $this->checkLogin();

        }

    }

    protected function checkLogin()
    {
        if (!isset($this->session->user)){
                return $this->redirect("/product");
            }
        return true;
    }


    public function logout()
    {
        if (isset($this->session->user)) {
            $this->session->remove('user');
        }
        return $this->redirect('login');
    }



    public function view($vue = null, $datas = [], $admin = false)
    {
        $template_dir = ($admin) ? "/templates/admin/" : "/templates/front/";

        // Merge flashdata with existing $datas
        $flashData = session()->getFlashdata('data');
        if ($flashData) {
            $datas = array_merge($datas, $flashData);
        }
        return view(
                $template_dir . 'head',
                [
                    'template_dir' => $template_dir,
                    'user' => ($this->session->user ?? null),
                    'title' => sprintf('%s : %s', $this->title, $this->title_prefix)
                ]
            )
            . (($vue !== null) ? view($vue, $datas) : '')
            . view($template_dir . 'footer', ['messages' => $this->messages]);
    }
    public function success($txt)
    {
        log_message('debug', $txt);
        $this->messages[] = ['txt' => $txt, 'class' => 'alert-success', 'toast' => 'success'];
    }

    public function message($txt)
    {
        log_message('debug', $txt);
        $this->messages[] = ['txt' => $txt, 'class' => 'alert-info', 'toast' => 'info'];
    }

    public function warning($txt)
    {
        log_message('debug', $txt);
        $this->messages[] = ['txt' => $txt, 'class' => 'alert-warning', 'toast' => 'warning'];
    }

    public function error($txt)
    {
        log_message('debug', $txt);
        $this->messages[] = ['txt' => $txt, 'class' => 'alert-danger', 'toast' => 'error'];
    }

    public function redirect(string $url, array $data = [])
    {

        //$url = implode('/', array_slice(func_get_args(), 1));
        $url = base_url($url);
        // Store messages in flashdata
        if (count($this->messages) > 0) {
            session()->setFlashdata('messages', $this->messages);
        }

        // Store additional data in flashdata
        if (!empty($data)) {
            session()->setFlashdata('data', $data);
        }
        header("Location: {$url}");
        exit; /** @phpstan-ignore-line */
    }


}
