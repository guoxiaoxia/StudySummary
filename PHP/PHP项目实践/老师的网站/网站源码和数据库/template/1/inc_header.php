<div id="header">
	<div class="container">
        <div class="header">
    	<a href="<?php echo $system_domain ?>" class="homepage-logo">
        	<img src="<?php echo $system_logo?>" title="<?php echo $system_name.'-'.$system_seoname; ?>" alt=""><span>简美<span>
        </a>
        <a href="channel.php?id=36" class="go-home">天罗地网</a>
        <a href="#" class="go-menu">导航</a>
        <a href="#" class="go-back">关闭</a>
       </div>
       <div class="decoration"></div>
    
       <div class="navigation">
    	<div class="navigation-wrapper">
            <div class="navigation-item">
                <a href="index.php" class="home-icon">首页</a>
                <em class="inactive-menu"></em>
            </div>
 		<?php
		$result = mysql_query('select * from cms_channel where c_parent = 0 order by c_order asc , id asc ');
		while ($row = mysql_fetch_array($result)){
			echo '<div class="navigation-item"><a href="'.c_url($row['id']).'" class="features-icon ';
			$results = mysql_query('select * from cms_channel where c_parent = '.$row['id'].' and c_nav <> 0 order by c_order asc , id asc ')or die(mysql_error());;
			$counti = 0;
			while ($rows = mysql_fetch_array($results)){
				if($counti == 0){
					echo ' has-submenu">'.$row['c_name'].'</a> <em class="dropdown-menu"></em><div class="submenu">';
					$counti++;
				}
				echo '<a href="'.c_url($rows['id']).'">'.$rows['c_name'].'   <em></em></a>';
			}
			if($counti != 0){
				echo '</div></div>';
			}else{
				echo '">'.$row['c_name'].'</a></div>';
			}
		}
		?>
        </div>
    </div>

	</div>
</div>

