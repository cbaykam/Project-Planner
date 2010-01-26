commit 0944e27fc89dbf9300c4d583874ae94ce19493ff
Author: cem <cem@msi.(none)>
Date:   Thu Jan 21 22:03:31 2010 +0200

    Proje sayfasini ve bug larin iliskilerini degistireceim simdiden sonra bir degisiklik olursa bu noktaya don.
    -------------------------------------------------------------------------------

diff --git a/views/elements/topnav.ctp b/views/elements/topnav.ctp
index 588e894..df9c661 100755
--- a/views/elements/topnav.ctp
+++ b/views/elements/topnav.ctp
@@ -3,9 +3,12 @@
 	<ul>
 				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
 				<li><?php echo $html->link("Customers" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
-				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
-				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
+				<li><?php echo $html->link("All Projects" , array('controller' => 'projects' , 'action' => 'allprojects' , 'master'=>true) ); ?></li>
+				<li><?php echo $html->link("Support Jobs" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
+				<li><?php echo $html->link("Redalto Jobs" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
 				<li><?php echo $html->link("Resources" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
+				<li><?php echo $html->link("My Tasks" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
+				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
 				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 	
 	</ul>
 <?php elseif(!in_array($this->params["url"]["url"] , $loginurls)):?>
commit e2378ae8e7ba710c04819b98951c568ab755a412
Author: cem <cem@msi.(none)>
Date:   Fri Jan 22 17:57:53 2010 +0200

    Added the new bug logic
    will code the notices and milestones complete.
    All tasks in the milestone has to be complete for a milestone to be completed.
    if a notice is created from the main page it wont have a project if its created from a project auto insert the project id.

diff --git a/views/elements/topnav.ctp b/views/elements/topnav.ctp
index df9c661..f5271fd 100755
--- a/views/elements/topnav.ctp
+++ b/views/elements/topnav.ctp
@@ -4,10 +4,10 @@
 				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
 				<li><?php echo $html->link("Customers" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
 				<li><?php echo $html->link("All Projects" , array('controller' => 'projects' , 'action' => 'allprojects' , 'master'=>true) ); ?></li>
-				<li><?php echo $html->link("Support Jobs" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
-				<li><?php echo $html->link("Redalto Jobs" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
+				<li><?php echo $html->link("Support Jobs" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true ) ); ?></li>
+				<li><?php echo $html->link("Redalto Jobs" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 1) ); ?></li>
 				<li><?php echo $html->link("Resources" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
-				<li><?php echo $html->link("My Tasks" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
+				<li><?php echo $html->link("My Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser','master'=>true , $user_idd) ); ?></li>
 				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
 				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 	
 	</ul>
