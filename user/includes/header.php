<!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"></h2>
                </a>
                <a href="" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
                <div class="navbar-nav align-items-center ms-auto">
                    
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                            <?php
$uid=$_SESSION['ocasuid'];
$sql="SELECT * from  tbluser where ID=:uid";
$query = $dbh -> prepare($sql);
$query->bindParam(':uid',$uid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                            <span class="d-none d-lg-inline-flex"><?php  echo $row->FullName;?></span><?php $cnt=$cnt+1;}} ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-white border-0 shadow-sm rounded m-0 mt-1 py-2">
                            <a href="profile.php" class="dropdown-item py-2"><i class="fa fa-id-card me-2 text-muted"></i>My Profile</a>
                            <a href="setting.php" class="dropdown-item py-2"><i class="fa fa-cog me-2 text-muted"></i>Settings</a>
                            <hr class="dropdown-divider my-2">
                            <a href="logout.php" class="dropdown-item py-2 text-danger"><i class="fa fa-sign-out-alt me-2"></i>Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->