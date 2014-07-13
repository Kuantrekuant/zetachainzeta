<section>
<div id="logo-region">
  <div class="row">
    <div class="small-8 large-3 large-offset-0 small-offset-2 columns logo">
	<a href="./" class="internal"><img src="./img/logo_small.png" alt="" /></a>
    </div>
    <div class="large-9 small-12 columns main-search-box" style="margin-bottom: 0">
	<form action="./index.php?engine=search" method="POST" >
		<input id="searchBox" name="query" type="text" placeholder="Search for block, transaction or address in " style="font-size: 1.2em;" size="64" />
	</form>
	</div>
</div>
</div>
</section>
</header>
<div id="main-region">
<div class="row">
<div class="large-12 columns">
		<h3>Top Richest Addresses</h3>
        <table class="fullwidth pointerCursor hover">
            <colgroup>
                <col width="40%">
				<col width="60%">
            </colgroup>
            <thead>
                <tr>
					<th class="blocksAmount">Address</th>
					<th class="blocksAmount">Value</th>
				</tr>
			</thead>
            <tbody>
<?php
	
	$recordsPerPage = 15;
	$pageNum = 1;
	if(isset($_GET['p'])) {
	  $pageNum = $_GET['p'];
	  settype($pageNum, 'integer');
	}
	$offset = ($pageNum - 1) * $recordsPerPage;
	
	$stmt = $mysqli->prepare("SELECT `address`,`value` FROM `keys` ORDER BY `value` DESC LIMIT ".$offset.", ".$recordsPerPage);
	$stmt->execute();
	$stmt->bind_result($address, $value);

	while ($stmt->fetch()) {
			$output .= '
            <tr class="block-member">
				<td class="blocksAmount"><b>' . $address . '</b></td>
				<td class="blocksAmount"><b>' . $value . '</b></td>
			</tr>';
	}
	
	$stmt->close();
	
	echo $output;
?>
			</tbody>
        </table>
        <?php
       
  $stmt = $mysqli->prepare("SELECT COUNT(address) AS addr FROM `keys`;");
	$stmt->execute();
	$stmt->bind_result($addr);

	while ($stmt->fetch()) {
		$maxPage = ceil($addr/$recordsPerPage);
	}

  $nav .= "&nbsp;&nbsp; Page: $pageNum &nbsp;&nbsp;";

  if ($pageNum > 1)  {
       $page = $pageNum - 1;
       $prev = "<a href=\"?engine=top&p=$page\"><strong><</strong></a>";
       $first = "<a href=\"?engine=top&p=1\"><strong><<</strong></a>&nbsp;&nbsp;";
  }
  else {
       $prev  = '<strong><</strong>';
       $first = '<strong><<&nbsp;&nbsp;</strong>';
  }
  if ($pageNum < $maxPage) {
       $page = $pageNum + 1;
       $next = "<a href=\"?engine=top&p=$page\"><strong>></strong></a>&nbsp;&nbsp;";
       $last = "<a href=\"?engine=top&p=$maxPage\"><strong>>></strong></a>";
  }
  else {
       $next = '<strong>>&nbsp;&nbsp;</strong>';
       $last = '<strong>>></strong>';
  }
  
  echo $data;
  echo '<br />';
  echo "<div class=\"pagingDiv\">
      $first
      $prev
      $nav
      $next
      $last</div>";
?>

	</div>
</div>
</div>
<div id="push"></div>
<br /><br /><br /><br />
</div>
