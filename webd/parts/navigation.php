	<div class="navigation">
			<div class="navigation-menu">
				<ul>
					<li><a href="index.php"><i class="fa fa-tachometer"></i><span>ダッシュボード</span></a></li>
					<li><a href="package_list.php"><i class="fa fa-list-alt"></i><span>パッケージリスト</span></a></li>
					<li><a href="host_manager.php"><i class="fa fa-list-alt"></i><span>ホストマネジャ</span></a></li>
					<li><a href="machine_list.php"><i class="fa fa-server"></i><span>マシン管理</span></a></li>
					<li><a href="profile.php"><i class="fa fa-cog"></i><span>設定</span></a></li>
				</ul>
			</div>
		</div>
		<div class="topbar">
			<div class="topbar-inner clearfix">
				<i class="fa fa-bars navigation-toggle"></i>
				<div class="topbar-title">
					<span class="eisen-logo">eisen</span>
				</div>

				<div class="menu clearfix">
					<div class="menu-button menu-machines menu-border">
						<div class="menu-icon">
							<i class="fa fa-server"></i>
							<div class="menu-icon-text">
								<span>Agent01</span>
							</div>
						</div>
						<div class="menu-popup">
							<div class="popup-title">
								<i class="fa fa-server fa-inline"></i>machine menu
							</div>
							<div class="popup-contents">
								<div class="menu-list-items">
									machine list and menu
								</div>
							</div>
						</div>
					</div>
                    <div class="menu-button menu-user menu-border">
                        <div class="menu-icon">
                            <i class="fa fa-user"></i>
                            <div class="menu-icon-text">
								<span>
									<?php
									print $me->get_user_id();
                                    ?>
								</span>
                            </div>
                        </div>

						<div class="menu-popup">
							<div class="popup-title">
								<i class="fa fa-user fa-inline"></i>user menu
							</div>
							<div class="popup-contents">
								<div class="menu-list-items">
									<span>user menu</span>
								</div>
							</div>
						</div>
                    </div>

                    <div class="menu-button menu-notifications menu-border">
						<div class="menu-icon">
							<i class="fa fa-bell-o"></i>
						</div>
						<div class="menu-popup">
							<div class="popup-title">
								<i class="fa fa-bell-o fa-inline"></i>Notifications
							</div>
							<div class="popup-contents">
								<div class="menu-list-items">
									<ul>
										<li>
											<span class="notifications-machine-name">WebServer</span>
											<span class="notifications-time">2015/07/07 14:44</span>
											<br>
											<span class="notifications-message">
											<i class="fa fa-check-circle fa-inline"></i>
												パッケージのインストールが完了しました
											</span>
										</li>
										<li>
											<span class="notifications-machine-name">WebServer</span>
											<span class="notifications-time">2015/07/07 12:31</span>
											<br>
											<span class="notifications-message">
											<i class="fa fa-times-circle fa-inline"></i>
												パッケージのインストールが失敗しました
											</span>
										</li>
										<li>
											<span class="notifications-machine-name">WebServer</span>
											<span class="notifications-time">2015/07/03 09:55</span>
											<br>
											<span class="notifications-message">
											<i class="fa fa-exclamation-circle fa-inline"></i>
												新しいパッケージの更新があります
											</span>
										</li>
										<li>
											<span class="notifications-machine-name">WebServer</span>
											<span class="notifications-time">2015/07/02 11:25</span>
											<br>
											<span class="notifications-message">
											<i class="fa fa-check-circle fa-inline"></i>
												パッケージの更新が完了しました
											</span>
										</li>
										<li>
											<span class="notifications-machine-name">WebServer</span>
											<span class="notifications-time">2015/07/01 21:19</span>
											<br>
											<span class="notifications-message">
											<i class="fa fa-check-circle fa-inline"></i>
												パッケージのインストールが完了しました
											</span>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
                </div>
			</div>
		</div>
