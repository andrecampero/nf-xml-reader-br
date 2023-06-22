<!-- BEGIN: Main Menu-->
<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-light navbar-without-dd-arrow navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper">
	<!-- Horizontal menu content-->
	<div class="navbar-container main-menu-content" data-menu="menu-container">

		<!-- include ../../../stack/includes/mixins-->
		<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
			
			<?php 
			// Menu - Submenu by profile
			$permissao_usuario = json_decode($_SESSION['permissao_usuario'], true);
			$menus = array_keys($permissao_usuario);
			$sub_menus = array();
			for ($i = 0; $i <= count($menus) - 1; $i++) {
				$key_sub = $menus[$i];
				if (array_key_exists($key_sub, $permissao_usuario)) {
					foreach ($permissao_usuario[$key_sub] as $key => $item) {
						$sub_menus[] = $item;
					}
				} 
			}
			
			// List in Menu
			$list_menus = implode(', ', $menus);
			
			// List in Submenu
			$sub_menus=array_filter($sub_menus);
			$list_sub_menus = implode(', ', $sub_menus);
			
			// Menu - Submenu
			$sql = "
				select * from xr_menu
				where 1 = 1
				and ativo = 1
				and id in ($list_menus)
				order by posicao asc
			";
			//echo $sql;
			$data = $conn->query($sql);
			$data_fetch = $data->FetchAll(PDO::FETCH_ASSOC);
			
			
			
			if($data_fetch)
			{
				foreach($data_fetch as $data_fetch_val)
				{
					$id_menu = $data_fetch_val['id'];
					?>
					
					<li class="dropdown nav-item" data-menu="dropdown"><a class="nav-link" href="<?php echo $data_fetch_val['link']; ?>" ><i class="<?php echo $data_fetch_val['icon']; ?>"></i><span data-i18n="Dashboard"><?php echo $data_fetch_val['mod']; ?></span></a>
						<?php
						$sql = "
							select * from xr_menu_sub
							where id_menu = $id_menu
							and ativo = 1
							and id in ($list_sub_menus)
							order by posicao asc
						";
						$data = $conn->query($sql);
						$data_fetch = $data->FetchAll(PDO::FETCH_ASSOC);

						if($data_fetch)
						{
							?>
							<ul class="dropdown-menu">
								<?php
								foreach($data_fetch as $data_fetch_val)
								{
									?>
									
										<li data-menu=""><a class="dropdown-item" href="<?php echo $data_fetch_val['link']; ?>" data-i18n="eCommerce" data-toggle="dropdown"><?php echo $data_fetch_val['submenu']; ?></a></li>
									
									<?php
								}
								?>
							</ul>
							<?php
						}
						?>							
					</li>
					
					<?php
				}
			}
			?>
		</ul>
	</div>
	<!-- /horizontal menu content-->
</div>
<!-- END: Main Menu-->