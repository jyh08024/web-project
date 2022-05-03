<?php 
	namespace model;
	use \model\info;

	/**
	 * 
	 */
	class reserve extends _base
	{
		public function myList()
		{
			$data = $this->fetchAll("SELECT * FROM `member` as a, `reserve` as b WHERE a.idx = b.user_idx && b.stat != '결제대기' && b.stat != '예약취소' && b.stat != '반납완료' && a.idx = ? ORDER BY `stat` DESC, `cur` DESC", [USER['idx']]);
			$cancle = $this->fetchAll("SELECT * FROM `member` as a, `reserve` as b WHERE a.idx = b.user_idx && (b.stat = '예약취소' || b.stat = '반납완료') && a.idx = ? ORDER BY `cur` DESC", [USER['idx']]);

			foreach ($data as $key => &$value) {
				$value = $this->convert($value);
			}
			foreach ($cancle as $key => &$value) {
				$value = $this->convert($value);
			}

			return [
				'list' => $data,
				'cancle' => $cancle
			];
		}

		public function getItem($res)
		{
			$data = $this->fetch("SELECT * FROM `member` as a, `reserve` as b WHERE a.idx = b.user_idx && b.idx = ?", [$res]);
			$data = $this->convert($data);

			return $data;
		}

		public function convert($data)
		{
			$i = (new info())->table('info');
			$data['info'] = $i->getItem($data['info_idx']);
			$data['pay'] = $this->getPay($data);
			return $data;
		}

		public function getPay($data)
		{
			$result = [];
			$dif = 1;
			$member = [
				"일반회원" => 5,
				"멤버십회원" => 10,
				"VIP회원" => 15
			];
			$sale = [-20,0,30,30,30,0,-20];
			$my = [];

			if ($data['info']['type'] == "시간") {
				$dif = date_diff(date_create($data['start']), date_create($data['end']))->h;
			} else {
				$dif = (date_diff(date_create($data['start']), date_create($data['end']))->days)+1;
			}
			for ($i=strtotime($data['start']); $i < strtotime($data['end']); $i+=86400) { 
				$my[] = $sale[date("w", $i)];
			}

			$my = array_unique($my);
			$mySale = array_sum($my) / count($my);
			if (count($my) == 3) {
				$mySale = 5;
			}

			$result['ori'] = $data['info']['price']*$dif;
			$result['sale'] = $result['ori'] * ($mySale/100);
			$result['salePay'] = $result['ori'] - $result['sale'];
			$result['member'] = $result['salePay'] * ($member[$data['level'] ?? USER['level']] / 100);
			$result['realPay'] = $result['salePay'] - $result['member'];

			return $result;
		}

		public function admin()
		{
			$data = [];
			$data['admin'] = $this->fetchAll("SELECT * FROM `member` as a, `reserve` as b WHERE a.idx = b.user_idx && (b.stat = '결제완료' || b.stat = '대기중' || b.stat = '반납완료') ORDER BY b.stat DESC, b.cur DESC");
			$data['item'] = $this->fetchAll("SELECT * FROM `member` as a, `reserve` as b WHERE a.idx = b.user_idx && (b.stat = '예약취소' || b.stat = '대기중') ORDER BY b.stat ASC, b.cur DESC");

			usort($data['admin'], function($a, $b) {
				$a = ($a['stat'] == "반납완료") ? 0 : ($a['stat'] == "결제완료" ? 2 : 3);
				$b = ($b['stat'] == "반납완료") ? 0 : ($b['stat'] == "결제완료" ? 2 : 3);
				return $b <=> $a;
			});
			foreach ($data['admin'] as $key => &$value) {
				$value = $this->convert($value);
			}
			foreach ($data['item'] as $key => &$value) {
				$value = $this->convert($value);
			}

			return $data;
		}

		public function refresh()
		{
			$this->mq("UPDATE `reserve` SET `stat` = '반납완료', `cancle` = '반납되었습니다.' WHERE `end` < ? && `stat` = '결제완료' ", [date("Y-m-d H:i:s")]);
			$this->mq("UPDATE `reserve` SET `stat` = '예약취소', `cancle` = '관리자에 의해 취소되었습니다.' WHERE `start` < ? && `stat` = '대기중' ", [date("Y-m-d H:i:s")]);
		}

		public function priceList($date)
		{
			$result = [];
			$end = ds("Y-m-t", $date);

			for ($i=strtotime($date); $i <= strtotime($end); $i+=86400) { 
				$s = date("Y-m-d 00:00:00", $i);
				$e = date("Y-m-d 23:59:59", $i);
				$result[date("m.d", $i)]['num'] = $this->rowCount("SELECT * FROM `reserve` WHERE `cur` > ? && `cur` < ? && (`stat` = '결제완료' || `stat` = '반납완료') ", [$s, $e]);
				$result[date("m.d", $i)]["total"] = 0;

				$temp = $this->fetchAll("SELECT * FROM `member` as a, `reserve` as b WHERE (b.stat = '결제완료' || b.stat = '반납완료') && a.idx = b.user_idx && b.cur > ? && b.cur < ?", [$s, $e]);

				foreach ($temp as $key => $value) {
					$result[date("m.d", $i)]["total"] += $this->convert($value)['pay']['realPay'];
				}
			}

			return $result;
		}
	}