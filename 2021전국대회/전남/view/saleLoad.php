<tbody class="load_div">
    			<?php foreach ($bread as $key => $v): ?>
    				<tr style="cursor: pointer" onclick="location.href = 'http://localhost/order/<?= $v['store_id'] ?>/<?= $v['bread_id'] ?>/'">
    					<td><?= $v['bread_name'] ?></td>
    					<td><img src="<?= $v['bread_image'] ?>" alt="bread" title="bread" class="menu_img"></td>
    					<td><?= number_format($v['price']) ?>원</td>
    					<td><?= $v['sale'] ?>%</td>
    					<td><?= number_format(round($v['price'] * ((100 - $v['sale']) / 100))) ?>원</td>
    					<td><?= $v['store_name'] ?></td>
    				</tr>
    			<?php endforeach ?>
    		</tbody>