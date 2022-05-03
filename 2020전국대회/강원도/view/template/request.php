<?php foreach ($req as $key => $v): ?>
	<tr>
	  <td><?= $v['req_name'] ?></td>
	  <td><?= $v['max'] ?></td>
	  <td><?= $v['priceRange'] ?></td>
	  <td>
	  	<a href="/reqDetail/<?= $v['idx'] ?>" class="btn">상세</a>
	  </td>
	</tr>
<?php endforeach ?>