<?php
require_once __DIR__ . '/../model/Notice.class.php';
$notice = new Notice();
require_once __DIR__ . '/../model/NoticeModel.class.php';
$noticeModel = new NoticeModel();
require_once $_SERVER['DOCUMENT_ROOT'] . '/public/Page.class.php';
if (isset($_REQUEST['flag'])) {
	$flag = $_REQUEST['flag'];
	switch ($flag){
		case 'list':
			$page = new Page();
			if (isset($_REQUEST['pageId'])) {
				$page->pageId = $_REQUEST['pageId'];
			}else{
				$page->pageId = 1;
			}
			$page->pageSize = 5;//每页显示5条数据
			$page->gotoUrl = 'noticeController.php?flag=list';//分页请求提交页面
			$noticeModel->getNoticeByPage($page);
			$notices = $page->result;
			require __DIR__ . '/../../../home/notice.html';
			break;
			
		case 'search':
			$page = new Page();
            if (isset($_REQUEST['pageId'])) {
                $page->pageId = $_REQUEST['pageId'];
            } else {
                $page->pageId = 1;
            }
            $page->pageSize = 10; //每页显示5条数据
            $page->gotoUrl = 'noticeController.php?flag=list'; //分页请求提交页面
            $noticeModel->getNoticeByPage($page);
			$notices = $page->result;
			require __DIR__ . '/../view/noticeList.html';
			break;
		
		case 'showAdd':
			require __DIR__ . '/../view/noticeAdd.html';
			break;
		
		case 'add':
			$notice->notice_name = $_REQUEST['txtNoticeName'];
			$notice->notice_web = $_REQUEST['txtWeb'];
			$notice->notice_time = $_REQUEST['txtTime']; 
//			echo $notice->notice_name, $notice->notice_web, $notice->notice_time; 
			$result = $noticeModel->noticeAdd($notice);
			if ($result == 1){
				header('location:noticeController.php?flag=search');
				exit();
			}
			break;
		case 'delete':
			$notice->notice_id  = $_REQUEST['noticeId'];
			$result = $noticeModel->noticeDelete($notice);
			if($result == 1) {
				//删除成功
				header('location:noticeController.php?flag=search');
				exit();
			}
			break;
		case 'showEdit':
			$notice->notice_id = $_REQUEST['noticeId'];
			$notice = $noticeModel->getNoticeById($notice->notice_id);
			require __DIR__ . '/../view/noticeEdit.html';
			break;
			
		case 'edit':
			$notice->notice_id = $_REQUEST['noticeId'];
			$notice->notice_name = $_REQUEST['txtNoticeName'];
			$notice->notice_web = $_REQUEST['txtWeb'];
			$notice->notice_time = $_REQUEST['txtTime']; 
			$result = $noticeModel->noticeEdit($notice);
			if ($result == 1 OR $result == 2 ) {
				header('location:noticeController.php?flag=search');
				exit();
			}
			break;
		default:
	}
}
?>