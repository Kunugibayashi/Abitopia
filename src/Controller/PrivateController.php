<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

class PrivateController extends AppController
{
    public function logstorage($filename)
    {
        $logfilePath = ROOT .Configure::read('Site.logfilepath');
        $logFile = $logfilePath .$filename;

        if (!file_exists($logFile)) {
            throw new NotFoundException(__('File not found'));
        }

        return $this->response->withFile($logFile);
    }

}
