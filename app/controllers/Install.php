<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');

        set_error_handler(array($this, 'errHandler'));
        set_exception_handler(array($this, 'errHandler'));
        register_shutdown_function(array($this, 'errHandler'));

        $this->load->vars('version', DD_VERSION);
        $this->load->model('db_model');

    }

    public function errHandler() {}

    private function check($db_host, $db_name, $db_pre, $db_user, $db_pwd) {
        $config['hostname'] = $db_host;
        $config['username'] = $db_user;
        $config['password'] = $db_pwd;
        $config['database'] = $db_name;
        $config['dbdriver'] = "mysqli";
        $config['dbprefix'] = $db_pre;
        $config['pconnect'] = false;
        $config['db_debug'] = false;
        $config['cache_on'] = false;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";

        $this->load->database($config);
        $data = $this->db_model->check();
        if (is_null($data)) {
            return false;
        }
        return true;
    }

    public function createTable($config) {
        $content = $this->load->view('install/ddvideo.sql.php', $config, true);
        $list    = explode(';', trim($content));

        // DROP TABLE IF EXISTS `dd_column_type`;
        foreach ($list as $key => $value) {
            $v = trim($value);
            $this->db_model->query($v);
        }

        $d = $this->db_model->addUser($config['username'], $config['password']);
        if ($d) {
            return true;
        }
        return false;
    }

    public function createConfigFile($config) {

        if (file_exists(ROOTPATH . '/dd-config.php')) {
            return true;
        }
        $config = <<<EOF
<?php
/** MySQL主机 */
define('DD_VERSION', '0.8');

/** MySQL主机 */
define('DD_DB_HOST', '{$config['db_host']}');

define('DD_DB_NAME', '{$config['db_name']}');

/** MySQL数据库用户名 */
define('DD_DB_USER', '{$config['db_user']}');

/** MySQL数据库密码 */
define('DD_DB_PASSWORD', '{$config['db_pwd']}');

/** MySQL数据库表前缀 */
define('DD_DB_PREFIX', '{$config['db_pre']}');

/** 创建数据表时默认的文字编码 */
define('DD_DB_CHARSET', 'utf8');

/** 数据库整理类型。如不确定请勿更改 */
define('DD_DB_COLLATE', '');
?>
EOF;
        file_put_contents(ROOTPATH . '/dd-config.php', $config);
        return true;
    }

    public function index() {

        if (file_exists(ROOTPATH . '/dd-config.php')) {
            redirect($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
            return true;
        }

        if (isset($_POST['install'])) {

            $key_list      = ['db_host', 'db_name', 'db_pre', 'db_user', 'db_pwd', 'username', 'password'];
            $key_list_name = ['数据库地址', '数据名', '表前缀', '用户名', '数据库密码', '账户名', '用户密码'];
            $is_has_err    = false;
            foreach ($key_list as $k => $v) {
                if (!isset($_POST[$v]) || empty($_POST[$v])) {
                    $this->load->vars('error', $key_list_name[$k] . '未设置!');
                    $is_has_err = true;
                    break;
                } else {
                    $this->load->vars($v, $_POST[$v]);
                }
            }

            if (!$is_has_err) {
                $isPass = $this->check($_POST['db_host'], $_POST['db_name'], $_POST['db_pre'], $_POST['db_user'], $_POST['db_pwd']);
                if (!$isPass) {
                    $this->load->vars('error', '数据库连接错误!');
                }

                $isOk = $this->createTable($_POST);
                if ($isOk) {
                    $this->createConfigFile($_POST);
                }

                $this->load->renderInstall('install/status');
                return;
            }
        }
        $this->load->renderInstall('install/index');
    }
}
