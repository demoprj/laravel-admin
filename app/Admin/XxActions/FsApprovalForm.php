<?php

namespace App\Admin\XxActions;

use App\Admin\XxActions\XxAction;
use Illuminate\Http\Request;

class FsApprovalForm extends XxAction
{
    protected $selector = '.fsapprovalform';
    protected $resp = '';
    protected $title = '';
    protected $form = [];

    public function handle(Request $request)
    {
        // return $this->response()->success($request->get('title'))->topCenter();
        dd($request);
        return $this->response()->success('good')->topCenter();
    }

    public function form()
    {
        $this->getApiResponse();

        $this->name = $this->title;
        $this->modalSmall();
        $this->xx_html('<div><img src="https://dss0.bdstatic.com/5aV1bjqh_Q23odCf/static/mancard/img/loading_new-f4a658cef0.gif" width=88px height=32px></img></div>', 'avatar');
        $formDefine = $this->form;
        $debugMode = false;
        foreach ($formDefine as $f) {
            $column = $f['id'];
            $label =  $f['name'];
            if ($debugMode) {
                if (array_key_exists('custom_id', $f)) {
                    $label .= ' (' . $f['type'] . ': '. $f['id'] . ': '. $f['custom_id'] . ')';
                } else {
                    $label .= ' (' . $f['type'] . ': '. $f['id'] . ')';
                }
            }
            
            switch ($f['type']) {
                case "text":
                    // $this->divider($label);
                    $this->divider('');
                    break;
                case "input":
                    $this->text($column, $label)->rules('required');
                    break;
                case "textarea":
                    $this->textarea($column, $label)->value('aa2');
                    break;
                case "number":
                    $this->integer($column, $label);
                    break;
                case "radioV2":
                    $this->select($column, $label)->options(array_column($f['option'], 'text'));
                    break;
                case "date":
                    $this->date($column, $label);
                    break;
                case "attachmentV2":
                    $this->file($column, $label);
                    break;
                case "contact":
                    // echo "contact";
                    break;
                default:
                    echo "unknown";
            }
        }

        // $this->text('title')->rules('required');
        // $this->textarea('content');
    }

    public function html()
    {
        return <<<HTML
<li>
    <a class="fsapprovalform" href="javascript:void(0);">
      <i class="fa fa-question"></i>
      <span>新建审批</span>
    </a>
</li>
HTML;
    }

    public function getApiResponse()
    {
        $response = '{
            "code": 0,
            "data": {
                "approval_name": "fsApprovalForm",
                "form": "[{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571512230001\",\"name\":\"说明 1\",\"printable\":true,\"required\":true,\"type\":\"text\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571488790001\",\"name\":\"单行文本a\",\"printable\":true,\"required\":true,\"type\":\"input\",\"widget_default_value\":\"\"},{\"custom_id\":\"desc\",\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571500530001\",\"name\":\"多行文本a\",\"printable\":true,\"required\":true,\"type\":\"textarea\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571649930001\",\"name\":\"说明 2\",\"printable\":true,\"required\":true,\"type\":\"text\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571737170001\",\"name\":\"数字a\",\"printable\":true,\"required\":true,\"type\":\"number\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571787220001\",\"name\":\"说明 4\",\"printable\":true,\"required\":true,\"type\":\"text\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517572288620001\",\"name\":\"单选a\",\"option\":[{\"value\":\"l2t1lum6-pwggunm9xvf-0\",\"text\":\"A\"},{\"value\":\"l2t1n2zb-btexpsdv3bl-1\",\"text\":\"B\"},{\"value\":\"l2t1n2zb-0g9a3eqa20yl-3\",\"text\":\"C\"}],\"printable\":true,\"required\":true,\"type\":\"radioV2\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517571934030001\",\"name\":\"说明 6\",\"printable\":true,\"required\":true,\"type\":\"text\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517572363390001\",\"name\":\"日期a\",\"printable\":true,\"required\":true,\"type\":\"date\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517572390370001\",\"name\":\"说明 7\",\"printable\":true,\"required\":true,\"type\":\"text\",\"widget_default_value\":\"\"},{\"custom_id\":\"tmpFile01\",\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517572021560001\",\"name\":\"附件a1\",\"printable\":true,\"required\":false,\"type\":\"attachmentV2\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517574136660001\",\"name\":\"附件a2\",\"printable\":true,\"required\":false,\"type\":\"attachmentV2\",\"widget_default_value\":\"\"},{\"default_value_type\":\"\",\"display_condition\":null,\"enable_default_value\":false,\"id\":\"widget16517572030750001\",\"name\":\"联系人a\",\"printable\":true,\"required\":false,\"type\":\"contact\",\"widget_default_value\":\"\"}]",
                "node_list": [
                    {
                        "name": "审批",
                        "need_approver": true,
                        "need_cc_user": false,
                        "node_id": "1dae791c90849cd7f2adf15069752065",
                        "node_type": "AND",
                        "requireSignature": false
                    },
                    {
                        "name": "结束",
                        "need_approver": false,
                        "need_cc_user": false,
                        "node_id": "b1a326c06d88bf042f73d70f50197905",
                        "node_type": "AND",
                        "requireSignature": false
                    },
                    {
                        "name": "发起",
                        "need_approver": false,
                        "need_cc_user": false,
                        "node_id": "b078ffd28db767c502ac367053f6e0ac",
                        "node_type": "AND",
                        "requireSignature": false
                    }
                ],
                "viewers": [
                    {
                        "open_id": "",
                        "type": "TENANT",
                        "user_id": ""
                    }
                ]
            },
            "msg": ""
        }';

        $this->resp = json_decode($response, true);
        if ($this->resp['code'] == 0) {
            $this->title = $this->resp['data']['approval_name'];
            $this->form = json_decode($this->resp['data']['form'], true);
        }
    }
}
