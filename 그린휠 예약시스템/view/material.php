	<div id="content">
		<div class="w100">
			<div class="material">
				<h1 class="title">기간별 매출관리</h1>
				<button onclick="location.href = '/material/<?= $year."-".pad($month -1) ?>'" class="formerly arrow">&lt;</button>
				<button onclick="location.href = '/material/<?= $year."-".pad($month +1) ?>'" class="next arrow">&gt;</button>
				<h2 class="date"><?= $month ?>월</h2>
				<table>
					<tr>
						<th rowspan="2">예약일</th>
						<th colspan="2">예약건수</th>
						<th colspan="2">결제금액</th>
					</tr>
					<tr>
						<th>건수</th>
						<th>증감</th>
						<th>금액</th>
						<th>증감</th>
					</tr>
					<?php $total = [0, 0] ?>
					<?php $arr = ["▼", "─", "▲"]; ?>
					<?php $prev = [0, 0]; ?>

					<?php foreach ($monthData as $key => $v): ?>
						<tr>
							<td><?= $key ?></td>
							<td><?= $v['count'] ?> 건</td>
							<td><?= $arr[($v['count'] <=> $prev[0]) + 1] ?></td>
							<td><?= number_format($v['total']) ?> 원</td>
							<td><?= $arr[($v['total'] <=> $prev[1]) + 1] ?></td>
						</tr>

						<?php 
							$total[0] += $v['count'];
							$total[1] += $v['total']; 
							$prev[0] = $v['count'];
							$prev[1] = $v['total'];
						 ?>
					<?php endforeach ?>
					<tr class="sum">
						<th>합계</th>
						<td><?= $total[0] ?> 건</td>
						<td>─</td>
						<td><?= number_format($total[1]) ?> 원</td>
						<td>─</td>
					</tr>
				</table>
				
				<h1 class="title">기간별 매출관리 현황</h1>
				<img src="<?= drawGraph($date) ?>" alt="기간별 매출관리 현황">
			</div>
		</div><!--w100-->
	</div><!--content-->
