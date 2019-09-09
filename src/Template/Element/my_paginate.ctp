<div align="right">
	<table>
		<tr>
			<td>
				<?php
				print_r("Number of display cases: ");
				print_r("<div class='btn-group'>");
				print_r("<button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown'>");
				// print_r("$show_num <span class='craret'></span>");
				print_r("</button>");
				print_r("<ul class='dropdown-menu' role='menu'>");
				$num_array = [10, 20, 50, 100];
				foreach ($num_array as $j) {
					print_r("<li><a href='?page=0&show_num=$j'>$j</a></li>");
				}
				print_r("</ul>");
				print_r("</div>");
				?>
			</td>
			<td>
				<div class="paginator">
					<p><?=$this->Paginator->counter() ?></p>
				</div>
			</td>
			<td>
				<div class="paginator">
					<ul class="pagination">
						<?=$this->Paginator->prev('< '.__('previous')) ?>
						<?=$this->Paginator->numbers(['before' => '', 'after' => '']) ?>
						<?=$this->Paginator->next(__('next').'>') ?>
					</ul>
				</div>
			</td>
		</tr>
	</table>
</div>