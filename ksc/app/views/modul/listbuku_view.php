List Buku-buku: 	
<?php
	$s="<ol>";
	$delUrl='';
	foreach($buku as $v)
	{
		if(@!is_null($del)){
			$delUrl="<a href='".
				base_url('rumah/hapus/'.$v['id']).
				"'>[hapus]</a>";
			
		}
		$s.="\n<li> ".$v['judul']." $delUrl</li>";
	}
	print $s ;
?>
	</ol>	
<?php
/* 
	 printf("<p/>Total : %d buku",$totalBuku);

	 printf("<p/>Total Rows: %d ",$totalRows);
*/
?>	