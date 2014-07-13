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
		<h3>Official Nodes <small><a href="./api/v1?engine=node">Node JSON API</a></small></h3>
        <table class="fullwidth pointerCursor hover">
            <colgroup>
                <col width="20%">
								<col width="10%">
                <col width="25%">
                <col width="25%">
                <col width="20%">
            </colgroup>
            <thead>
                <tr>
					<th class="blocksAmount">IP</th>
					<th class="blocksAmount">PORT</th>
					<th class="blocksAmount hide-for-small">Owner</th>
					<th class="blocksAmount">Version</th>
					<th class="blocksAmount">STATUS</th>
				</tr>
			</thead>
            <tbody>
<?php
	$offnode = "";
	
	$stmt = $mysqli->prepare("SELECT `ip`,`port`,`owner`,`version`,`status` FROM `nodes` ORDER BY `version` DESC, `owner` DESC");
	$stmt->execute();
	$stmt->bind_result($ip, $port, $owner, $version, $nodestatus);

	while ($stmt->fetch()) {
		if ($nodestatus == 1) { $status = "node.png"; } else { $status = "no_node.png"; }
		
			$offnode .= '
            <tr class="block-member">
				<td class="blocksAmount"><b>' . $ip . '</b></td>
				<td class="blocksAmount"><b>' . $port . '</b></td>
				<td class="blocksAmount hide-for-small">' . $owner . '</td>
				<td class="blocksAmount">' . $version . '</td>
				<td class="blocksAmount"><img src="./img/' . $status . '" alt="" /></td>
			</tr>';
	}
	
	$stmt->close();
	
	echo $offnode;
?>
			</tbody>
    </table>
	</div>
</div>
</div>
<div id="push"></div>
<br /><br /><br /><br />
</div>
