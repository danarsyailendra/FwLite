<?php

namespace Controllers;

use lib\MVC\Controller\BaseController;
use lib\MVC\Model\BaseModel;
class Home extends BaseController{

    protected function Index() {
        $viewModel['data_coba'] = 'Hello World';
        $this->load('Home/Index',$viewModel);
    }

}