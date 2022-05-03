	
	<div id="content">
		<div class="w100">
			<div class="material">
				<h1 class="title">기간별 매출관리</h1>
				<button onclick="location.href='?date=<?php echo $prev ?>'" class="formerly arrow">&lt;</button>
				<button onclick="location.href='?date=<?php echo $next ?>'" class="next arrow">&gt;</button>
				<h2 class="date"><?php echo ds("m", $date) ?>월</h2>
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
					<?php $arr = ["▼", "─", "▲"]; ?>
					<?php $numTotal = 0; ?>
					<?php $totalTotal = 0; ?>
					<?php foreach ($list as $key => $value): ?>
						<?php $numTotal += $value['num'] ?>
						<?php $totalTotal += $value['total'] ?>
						<tr>
							<td><?php echo $key ?></td>
							<td><?php echo $value['num'] ?> 건</td>
							<td><?php echo $arr[($value['num'] <=> ($prev1 ?? $value['num'])) + 1] ?></td>
							<td><?php echo number_format($value['total']) ?> 원</td>
							<td><?php echo $arr[($value['total'] <=> ($prev2 ?? $value['total'])) + 1] ?></td>
						</tr>
						<?php $prev1 = $value['num'] ?>
						<?php $prev2 = $value['total'] ?>
					<?php endforeach ?>
					<tr class="sum">
						<th>합계</th>
						<td><?php echo number_format($numTotal) ?> 건</td>
						<td>─</td>
						<td><?php echo number_format($totalTotal) ?> 원</td>
						<td>─</td>
					</tr>
				</table>
				
				<h1 class="title">기간별 매출관리 현황</h1>
				<img src="/chart/<?php echo $date ?>" alt="기간별 매출관리 현황">
			</div>
		</div><!--w100-->
	</div><!--content-->
	
</body>
</html>