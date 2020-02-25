<?php
/**
 * 
 */
require_once __DIR__ . '/../../../public/Db.class.php';
class NoticeModel
{
	public function getNotice()
	{
		$sql = "SElECT
					t_notice.notice_id,
					t_notice.notice_name,
					t_notice.notice_time,
					t_notice.notice_web,
					t_notice.state
				FROM
					t_notice
				WHERE
					t_notice.state = 1
				ORDER BY
					t_notice.notice_id ASC";
		$db = Db::getInstance();
		$arrayResult = $db->dql($sql);
		return $arrayResult;
	}
	
	public function getNoticeById($noticeId)
	{
		$sql = "SElECT
			t_notice.notice_id,
			t_notice.notice_name,
			t_notice.notice_time,
			t_notice.notice_web,
			t_notice.state
		FROM
			t_notice
		WHERE
			t_notice.notice_id = $noticeId
		AND t_notice.state = 1";
		$db = Db::getInstance();
		$arrayResult = $db->dql($sql);
		return $arrayResult[0];
	}
	
	public function getNoticeByPage($page)
	{
		$offset = ($page->pageId - 1) * $page->pageSize;
		$rows = $page->pageSize;
		$sql1 = "SElECT
					t_notice.notice_id,
					t_notice.notice_name,
					t_notice.notice_time,
					t_notice.notice_web,
					t_notice.state
				FROM
					t_notice
				WHERE state = 1
				ORDER BY notice_id ASC
				LIMIT $offset, $rows";
		$sql2 = "SElECT COUNT(*) FROM t_notice WHERE state = 1";
		$db = Db::getInstance();
		$db->dqlByPage($sql1, $sql2, $page);
	}
	
	public function noticeAdd($notice)
	{
		$noticeName = $notice->notice_name;
		$noticeTime = $notice->notice_time;
		$noticeWeb = $notice->notice_web;
		if ($noticeTime !=''){//如果日期不为空
			$sql = "INSERT INTO `t_notice`(
					`notice_name`,
					`notice_time`,
					`notice_web`
				)
				VALUES (
					'$noticeName',
					'$noticeTime',
					'$noticeWeb'
				)";
		}else{//如果日期为空
			$sql = "INSERT INTO `t_notice`(
					`notice_name`,
					`notice_web`,
					`notice_time`
				)
				VALUES (
					'$noticeName',
					'$noticeWeb',
					NULL
				)";
		}
		$db = Db::getInstance();
		$result = $db->dml($sql);
		return  $result;
	}
	
	public function noticeEdit($notice)
	{
		$noticeId = $notice->notice_id;
		$noticeName = $notice->notice_name;
		$noticeTime = $notice->notice_time;
		$noticeWeb = $notice->notice_web;
		if($noticeTime == '') {
			$sql = "UPDATE `t_notice`
		  		SET
		  			`notice_name`='$noticeName',
		  			`notice_web`='$noticeWeb'
		  			`notice_time`=NULL,
		  		WHERE (`notice_id`='$noticeId')";
		}else{
			$sql = "UPDATE `t_notice`
		  		SET
		  			`notice_name`='$noticeName',
		  			`notice_time`='$noticeTime',
		  			`notice_web`='$noticeWeb'
		  		WHERE (`notice_id`='$noticeId')";
		}
		
		$db = Db::getInstance();
		$result = $db->dml($sql);
		return $result;
	}

	public function noticeDelete($notice)
	{
		$sql = "UPDATE `t_notice` SET `state`='0' WHERE (`notice_id`='$notice->notice_id')";
//		$sql = "DELETE FROM `t_notice` WHERE (`notice_id` = '$noticeId')";
		$db = Db::getInstance();
		$result = $db->dml($sql);
		return $result;
	}
	
}
?>