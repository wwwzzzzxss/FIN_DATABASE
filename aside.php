
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="screen,projection">

<aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				 <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
                <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi mdi-food-fork-drink"></i>點餐</a>
                            </li>
                        </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i>訂單</a>
                            <div class="collapsible-body">
                                <ul>
                                <li><a href="all-orders.php?order=part">訂單(!!)</a>
                                </li>
								<li><a href="all-orders.php?order=all">所有訂單</a>
                                </li>
                                <li><a href="orders.php">顧客訂單</a>
                                </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i>問題</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="tickets.php">所有問題</a>
                                </li>
								
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> 編輯個人資料</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="password_change.php">修改密碼</a>
                                </li>
                                <li><a href="details.php">個人資訊</a>
                                </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>		
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('slide-out').classList.toggle('collapsed');
    });

</script>       