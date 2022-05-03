<?php 
	namespace model;
	use \model\reserve;

	/**
	 * 
	 */
	class info extends _base
	{

		public function getMemo()
		{
			$r = new reserve();
			$memos = $this->fetchAll("SELECT * FROM `member` as b, `memo` as a WHERE a.user_idx = b.idx && a.user_idx = ?", [USER['idx']]);
			foreach ($memos as $key => &$value) {
				$value['info'] = $this->getItem($value['info_idx']);
				$value['pay'] = $r->getPay($value);
			}
			return $memos;
		}
		
		public function getList($category, $start = '', $end = '')
		{
			$data = $this->get("WHERE `category` = ?", [$category]);

			foreach ($data as $key => &$value) {
				$value = $this->convert($value, $start, $end);
			}

			return $data;
		}

		public function getItem($idx)
		{
			$data = $this->for($idx);
			return $this->convert($data);
		}

		public function convert($val, $start = '', $end = '')
		{
			$val['detail'] = explode(',', $val['detail']);
			$val['type'] = "기간";
			if (in_array($val['category'], ["전기자전거", "미니전기자동차", "전기스쿠터"])) {
				$val['type'] = "시간";
			}
			if ($start) {
				$val['curQuan'] = $val['quantity'] - $this->rowCount("SELECT * FROM `reserve` WHERE (`stat` = '결제완료' || `stat` = '대기중') && `info_idx` = ?  && !(? <= `start` || `end` <= ?) ", [$val['idx'], $end, $start]);
			}

			return $val;
		}

		public function isOk($start, $end, $step)
		{
			if ($start < date("Y-m-d H:i:s")) {
				return "대여시간이 현재시간보다 이전입니다.";
			}
			if ($start >= $end) {
				return "반납시간이 대여시간보다 이전입니다.";
			}
			if ($start >= date("Y-m-d H:i:s", strtotime($end)+3600)) {
				return "반납시간은 대여시간 기준으로 1시간 이후부터 반납가능합니다.";
			}

			return "";
		}

	}