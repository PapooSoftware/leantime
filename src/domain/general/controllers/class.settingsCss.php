<?php

namespace leantime\domain\controllers {

    use leantime\core;

    class settingsCss
    {

        public function run()
        {

            $tpl = new core\template();

            $tpl->displayPartial('general.settingsCss');
        }
    }
}
