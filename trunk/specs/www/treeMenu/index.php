<?php
  // Chip's HTML_TreeMenu Information Page
  
  // Revision History
	// 2002-12-02 cchapin  Release XL2.0.2
	// 2002-11-15 cchapin  Fix PHP short tag in document template.
	// 2002-11-14 cchapin  Major update for release 1.1.0/XL2.0
  // 2002-11-02 cchapin  Revised to use HTML_TreeMenuXL class
  // 2002-11-02 cchapin  Initial release (XL1.0)
  // 2002-10-30 cchapin  Initial Creation
  
// +-----------------------------------------------------------------------+
// | Copyright (c) 2002 Chip Chapin <cchapin@chipchapin.com>               |
// |                    http://www.chipchapin.com                          |
// | All rights reserved.                                                  |
// |                                                                       |
// | Redistribution and use in source and binary forms, with or without    |
// | modification, are permitted provided that the following conditions    |
// | are met:                                                              |
// |                                                                       |
// | o Redistributions of source code must retain the above copyright      |
// |   notice, this list of conditions and the following disclaimer.       |
// | o Redistributions in binary form must reproduce the above copyright   |
// |   notice, this list of conditions and the following disclaimer in the |
// |   documentation and/or other materials provided with the distribution.| 
// | o The names of the authors may not be used to endorse or promote      |
// |   products derived from this software without specific prior written  |
// |   permission.                                                         |
// |                                                                       |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
// |                                                                       |
// +-----------------------------------------------------------------------+
// | Author: Chip Chapin <cchapin@chipchapin.com>                          |
// +-----------------------------------------------------------------------+

  $pgEmailSubj = 'HTML_TreeMenu_Page';

  // Control dynamic style sheet
  $styleBodyIndent=true;
  $styleBodyBGcolor="#FFDBB7";

  if (file_exists( 'TreeMenuXL.php' ))
    include_once( 'TreeMenuXL.php' );
  else 
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/bin/TreeMenuXL.php' );

  // Menu00 -- Based on the original example
  // Should be as basic as possible.
  $menu00  = new HTML_TreeMenuXL();
  $nodeProperties = array("icon"=>"folder.gif");
  $node0 = new HTML_TreeNodeXL("INBOX", "#", $nodeProperties);
  $nx = &$node0->
    addItem(new HTML_TreeNodeXL("A Folder", "#link1", $nodeProperties));
  $nx = &$nx->
      addItem(new HTML_TreeNodeXL("Nested Folder", "#link2", $nodeProperties));
  $nx = &$nx->
        addItem(new HTML_TreeNodeXL("Deeper ...", "#link3", $nodeProperties));
  $nx = &$nx->
          addItem(new HTML_TreeNodeXL("... and Deeper", "#link4", $nodeProperties));
  
  $node0->addItem(new HTML_TreeNodeXL("deleted-items", "#link5", $nodeProperties));
  $node0->addItem(new HTML_TreeNodeXL("sent-items",    "#link6", $nodeProperties));
  $node0->addItem(new HTML_TreeNodeXL("drafts",        "#link7", $nodeProperties));	
  $node0->addItem(new HTML_TreeNodeXL("spam",          "#link8", $nodeProperties));	
  
  $menu00->addItem($node0);
  $menu00->addItem(new HTML_TreeNodeXL("My Stuff",     "#link9", $nodeProperties));
  $menu00->addItem(new HTML_TreeNodeXL("Other Stuff",  "#link10", $nodeProperties));
  $menu00->addItem($node0);

  // Menu03 -- This uses no icons.  The plus/minus are still present
  $nodeProperties = array("cssClass"=>"auto");
  $menu03  = new HTML_TreeMenuXL();
  $node03  = new HTML_TreeNodeXL("INBOX", "#", $nodeProperties);
  $nx = &$node03->
    addItem(new HTML_TreeNodeXL("A Folder", "#link1", $nodeProperties));
  $nx = &$nx->
      addItem(new HTML_TreeNodeXL("Nested Folder", "#link2", $nodeProperties));
  $nx = &$nx->
        addItem(new HTML_TreeNodeXL("Deeper ...", "#link3", $nodeProperties));
  $nx = &$nx->
          addItem(new HTML_TreeNodeXL("... and Deeper", "#link4", $nodeProperties));

  $node03->addItem(new HTML_TreeNodeXL("deleted-items", "#link5", $nodeProperties));
  $node03->addItem(new HTML_TreeNodeXL("sent-items",    "#link6", $nodeProperties));
  $node03->addItem(new HTML_TreeNodeXL("drafts",        "#link7", $nodeProperties));	
  $node03->addItem(new HTML_TreeNodeXL("spam",          "#link8", $nodeProperties));	
  
  $menu03->addItem($node03);
  $menu03->addItem(new HTML_TreeNodeXL("My Stuff",      "#link9", $nodeProperties));
  $menu03->addItem(new HTML_TreeNodeXL("Other Stuff",   "#link10", $nodeProperties));
  $menu03->addItem($node03);
  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"><html><!-- InstanceBegin template="/Templates/stdlayout01.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>HTML_TreeMenuXL Info Page</title>
<script src="TreeMenu.js" language="JavaScript" type="text/javascript"></script>
<link href="TreeMenu.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}
//-->
</script>
<!-- InstanceEndEditable --> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
  // Include dynamic style sheet.
  echo '<style type="text/css">'."\n  <!--\n";
  if (file_exists( 'ccSiteStyle.css.php' )) {
    include_once( 'ccSiteStyle.css.php' );
  } 
  else {
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/ccSiteStyle.css.php' );
  }
  echo "\n  -->\n</style>\n";
  if (false) {
?>
<link href="/ccSiteStyle.css" rel="stylesheet" type="text/css">
<?php } ?>
<script type="text/javascript" language="JavaScript">
  // Bust my page out of any frames
  if (top != self) top.location.href = location.href;
</script>
</head>

<body bgcolor="#FFDBB7">
<!-- InstanceBeginEditable name="MainTitle" -->
<h1 style="text-align:left">HTML_TreeMenuXL</h1>
<!-- InstanceEndEditable --> <!-- InstanceBeginEditable name="MainBody" --> 
<h3>An Enhanced Version of HTML_TreeMenu</h3>
<table summary="" width="640">
  <tr> 
    <td align="left"><a href="../../../">Chip's Home</a> &gt; <a href="../../">WebTools</a> 
      &gt; <a href="../">MenuTools</a> &gt; <strong>HTML_TreeMenuXL</strong></td>
    <td align="center">&nbsp;</td>
    <td align="RIGHT">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3"> <hr> </td>
  </tr>
</table>
<table width="240" border="0" align="right" cellpadding="2" cellspacing="4">
  <tr> 
    <td> <p><strong>Page Revision History</strong></p>
      <ul>
        <li>2002-12-02 minor patches (XL2.0.2)</li>
        <li><span class="smalltext">2002-11-15 minor patches (XL2.0.1).</span></li>
        <li><span class="smalltext">2002-11-14 Major Update (1.1.0/XL2.0) based 
          on TreeMenu 1.1.0.</span></li>
        <li><span class="smalltext">2002-11-08 Update (1.1a) Smarter path handling 
          on includes. Change image dirnames.</span></li>
        <li><span class="smalltext">2002-11-07 New Release (1.1). Add ListboxMenus 
          and property list interface. Added expansion and highlighting of selected 
          branches, image size control and style sheet overrides.</span></li>
        <li><span class="smalltext">2002-11-02 TreeMenuXL Initial Release (1.0), 
          based on TreeMenu 1.0.4</span></li>
      </ul>
      <?php 
  $nodeProperties = array();
  $pgmenu  = new HTML_TreeMenuXL();
  $pgmenuTop  = new HTML_TreeNodeXL("TreeMenuXL Page Contents", "#", $nodeProperties);
  $pgmenu->addItem($pgmenuTop);
  $nx = &$pgmenuTop->
    addItem(new HTML_TreeNodeXL("Introduction to HTML_TreeMenuXL", "#intro", $nodeProperties));
  $nx = &$pgmenuTop->
    addItem(new HTML_TreeNodeXL("Using HTML_TreeMenuXL", "#chips_version", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Basic TreeMenus", "#basic", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenus With Style", "#style", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenus Without Icons", "#noicons", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Rigid and Expanded TreeMenus", "#rigid", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Controlling Indenting and Vertical Spacing", "#advanced_spacing", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("LinkSelect, User Images and User Styles", "#advanced_linkselect", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Listbox Menus", "#listbox", $nodeProperties));
  $nx = &$pgmenuTop->addItem(new HTML_TreeNodeXL("History of TreeMenuXL", "#history", $nodeProperties));  
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenuXL 1.1", "#xl11", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("TreeMenuXL 1.2", "#xl12", $nodeProperties));
  $nx->
    addItem(new HTML_TreeNodeXL("Summary of New Features in TreeMenuXL", "#summary_of_new_features", $nodeProperties));
  $pgmenuTop->addItem(new HTML_TreeNodeXL("HTML_TreeMenu Reference", "#reference", $nodeProperties));  
  $pgmenuTop->addItem(new HTML_TreeNodeXL("Things To Do", "#thingstodo", $nodeProperties));  
  $pgmenuTop->addItem(new HTML_TreeNodeXL("TreeMenuXL Source Code", "#sourcecode", $nodeProperties));  

  // Create the presentation object
  $pgmenuTree = &new HTML_TreeMenu_RigidXL($pgmenu, array('images'=>'TMimagesAlt', "defaultClass"=>"auto"));
  $pgmenuTree->printMenu();
?>
      <p class="smallitalic">Above is a Rigid TreeMenu using default Autostyles, 
        Alternate navigation graphics, and no icons.</p></td>
  </tr>
</table>
<h2>What's Here?</h2>
<p><strong> HTML_TreeMenu </strong>is a wonderful PEAR package by Richard Heyes 
  for generating dynamic tree menus using PHP. <strong> HTML_TreeMenuXL</strong> 
  is my enhanced version of HTML_TreeMenu. My enhancements have been intended 
  to extend its flexibility and fix a few problems, and I've been placed that 
  Richard has incorporated many of my ideas back into the base package. </p>
<p>This page demonstrates <strong> HTML_TreeMenuXL</strong>, documents its usage, 
  and offers access to the source code.</p>
<h2><a name="intro"></a>Introduction to HTML_TreeMenuXL</h2>
<p><strong>HTML_TreeMenu</strong> (also referred to as &quot;TreeMenu&quot;) is 
  a PHP component for generating dynamic tree-structured menus. TreeMenu will 
  generate the appropriate combination of JavaScript and HTML for a collapsible 
  vertical tree listing that resembles the Windows Explorer folder view. Expandable 
  elements can be used as links, or they can be expanded. Other menu presentations 
  are also possible. TreeMenu is a semi-standard, being part of the <a href="http://pear.php.net/" target="_blank"><strong>PEAR</strong></a> 
  PHP component library since its initial release 2002-06-15. </p>
<p><strong>HTML_TreeMenuXL</strong> is my (Chip Chapin's) enhanced version of 
  TreeMenu. It is not my objective to create a fork of the <strong>HTML_TreeMenu</strong> 
  component. As much as possible, the <strong>XL</strong> features are done using 
  subclasses, and Richard Heyes, the author of TreeMenu, has been very reasonable 
  about considering my ideas for inclusion in TreeMenu. The extensive changes 
  he made in TreeMenu 1.1 incorporated many of my ideas at the time, fixed a few 
  problems, and provided an improved interface which has greatly simplified the 
  current form of TreeMenuXL. Nevertheless, the current TreeMenuXL release still 
  requires modified versions of his core TreeMenu.php and TreeMenu.js files.</p>
<p> The original HTML_TreeMenu package consists of two PHP Classes: a <strong><em>TreeMenu</em></strong> 
  class and a <strong><em>TreeNode</em></strong> class, each with a corresponding 
  JavaScript class. Menus are built as a hierarchy of tree nodes. With the 1.1 
  release came the addition of <strong> <em>Presentation</em></strong> classes. 
  Now the menu and node classes are independent of the actual menu presentation. 
  This means the same menu object can be used to generate several different types 
  of menu presentations. More importantly, it is now much easier to add new types 
  of menus to the TreeMenu package.</p>
<blockquote> 
  <p> <strong>HTML_TreeMenu Home</strong>: <a href="http://pear.php.net/package-info.php?pacid=77" target="_blank">http://pear.php.net/</a> 
    and <a href="http://phpguru.org/treemenu.php" target="_blank">http://phpguru.org/treemenu.php</a><br>
    Last Updated: 2002-11-10 (v1.1.0) </p>
</blockquote>
<table>
  <tr> 
    <td width="48">&nbsp;</td>
    <td> 
      <?php
  // Create the presentation object
	$props = array('images'=>'TMimages', "defaultClass"=>"auto");
  $pgmenuDTree = &new HTML_TreeMenu_DHTMLXL($pgmenu, $props);
  $pgmenuDTree->printMenu();
?>
    </td>
  </tr>
  <tr> 
    <td></td>
    <td class="smallitalic"> Above is a DHTML TreeMenu using default Autostyles, 
      standard navigation graphics, and no icons.</td>
  </tr>
</table>
<h2><a name="chips_version"></a>Using TreeMenuXL</h2>
<p>The examples in this section illustrate how to use HTML_TreeMenuXL. In some 
  cases, there may be no significant difference between using TreeMenuXL and using 
  TreeMenu. However I've stuck with the XL interface for consistency. Whereever 
  possible, I'll try to point out where something is an XL-only feature.</p>
<h3><a name="basic"></a>Basic TreeMenus</h3>
<p>The basic procedure to create a menu is only three steps:</p>
<ol>
  <li>Create a <strong>TreeMenu</strong> object and a tree of <strong>TreeNodes</strong>, 
    one node for each menu item.</li>
  <li>Create a <strong>Presentation</strong> object for the type of menu you wish 
    to display.</li>
  <li>Print it (generate the HTML and JavaScript).</li>
</ol>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 1.0<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles</strong></td>
    <td><strong>Menu 1.1<br>
      Folder Icon /<br>
      Alt Images<br>
      No Styles</strong></td>
    <td><strong>Menu 1.2<br>
      Folder Icon /<br>
      Alt2 Images<br>
      No Styles</strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php 
        // Create the presentation object
        $example010 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages"));
        $example010->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php 
        $example011 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimagesAlt"));
        $example011->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php 
        $example012 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimagesAlt2"));
        $example012->printMenu();
      ?>
    </td>
  </tr>
  <tr> 
    <td colspan="3" valign="top"> <p><strong>Note: </strong>In older browsers, 
        these menus will be appear <em>fully expanded</em> and will be <em>static.</em> 
        In newer browsers the menus can be expanded and collapsed by clicking 
        on the<img src="TMimagesAlt/plus.gif" alt="plus icon" width="20" height="20" align="absmiddle">and<img src="TMimagesAlt/minus.gif" alt="minus icon" width="20" height="20" align="absmiddle">icons 
        in the tree.</p></td>
  </tr>
</table>
<p align="center"><em><strong>Table 1 -- Basic TreeMenus</strong></em></p>
<p><strong>Table 1</strong> shows simple TreeMenus drawn with the &quot;folder&quot; 
  icons included with the package. It is also possible to specify a custom icon 
  or no icon for each menu entry. The entries in Table 1 use the three sets of 
  TreeMenu images supplied by Mr Heyes with the distribution package, which I'll 
  refer to as the &quot;Standard Images&quot;, &quot;Alt Images&quot;, and &quot;Alt2 
  Images&quot;. The three sets each include navigation images (line art, plusses 
  and minusses) and a folder icon. <em>Note that the drawn lines are not visible 
  in the &quot;Alt Images&quot; version.</em></p>
<p>Below is the PHP code that produced the menus in Table 1. First we create a 
  TreeMenu object and TreeNodes, then we create a Presentation object, and finally 
  we generate the menu.</p>
<blockquote> 
  <p> 
    <?php
  $mcode = '  require_once("TreeMenuXL.php");
  
	// Create the Menu object and the menu tree
  $menu00  = new HTML_TreeMenuXL();
  $nodeProperties = array("icon"=>"folder.gif");
  $node0 = new HTML_TreeNodeXL("INBOX", "#", $nodeProperties);
  $nx = &$node0->
    addItem(new HTML_TreeNodeXL("A Folder", "#link1", $nodeProperties));
  $nx = &$nx->
      addItem(new HTML_TreeNodeXL("Nested Folder", "#link2", $nodeProperties));
  $nx = &$nx->
        addItem(new HTML_TreeNodeXL("Deeper ...", "#link3", $nodeProperties));
  $nx = &$nx->
          addItem(new HTML_TreeNodeXL("... and Deeper","#link4", $nodeProperties));
  $node0->addItem(new HTML_TreeNodeXL("deleted-items", "#link5", $nodeProperties));
  $node0->addItem(new HTML_TreeNodeXL("sent-items",    "#link6", $nodeProperties));
  $node0->addItem(new HTML_TreeNodeXL("drafts",        "#link7", $nodeProperties));	
  $node0->addItem(new HTML_TreeNodeXL("spam",          "#link8", $nodeProperties));	  
  $menu00->addItem($node0);
  $menu00->addItem(new HTML_TreeNodeXL("My Stuff",     "#link9", $nodeProperties));
  $menu00->addItem(new HTML_TreeNodeXL("Other Stuff",  "#link10", $nodeProperties));
  $menu00->addItem($node0);

  // Menu 1.0
  // Create the presentation object.
  // It will generate HTML and JavaScript for the menu
  // These statements must occur in your HTML exactly where you want the menu to appear.
  $example010 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages"));
  $example010->printMenu();
  
  // Menu 1.1
  // Create another presentation object from the same menu, 
  // but using an alternate image directory
  $example011 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimagesAlt"));
  $example011->printMenu();
  
  // Menu 1.2
  $example012 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimagesAlt2"));
  $example012->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<p>Note that the same TreeMenu object is used to produce each of the menus, only 
  different presentation objects are created, each with a different image directory. 
  For now, we will only be working with presentation objects of the class <strong>HTML_TreeMenu_DHTMLXL</strong>. 
  This is the XL version of the general purpose dynamic tree menu class.</p>
<p>Also, notice that each node is created with a property list. The only property 
  defined in the list at this time is <strong>icon</strong>, which is the file 
  name of the icon that will appear just before the node text (in this case, a 
  file folder).</p>
<p>The HTML_TreeMenu package generates JavaScript code which dynamically creates 
  and controls the menu on the client. There is one supporting JavaScript file 
  which must be included in web pages that use the package as follows:</p>
<blockquote> 
  <pre>&lt;script src=&quot;TreeMenu.js&quot; language=&quot;JavaScript&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;<br></pre>
</blockquote>
<h3><a name="style"></a>TreeMenus With Style</h3>
<p>Next, let's look at how one can use CSS (Cascading Style Sheets) classes to 
  control the appearance of the different menu levels.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 1.0<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles</strong></td>
    <td><strong>Menu 2.1<br>
      Folder Icon /<br>
      Standard Images /<br>
      Default Styles</strong></td>
    <td><strong>Menu 2.2<br>
      Folder Icon /<br>
      Standard Images /<br>
      User Styles</strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php  // Menu 1.0
        $example010->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php  // Menu 2.1
        $menuProperties = array("images"=>"TMimages", "defaultClass"=>'auto');
        $example021 = &new HTML_TreeMenu_DHTMLXL($menu00, $menuProperties);
        $example021->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php  // Menu 2.2
        $menuProperties = array("images"=>"TMimages", "defaultClass"=>'auto',
                                "autostyles"=>array("smalltextBold", "smallitalic", "smalltext") );
        $example022 = &new HTML_TreeMenu_DHTMLXL($menu00, $menuProperties);
        $example022->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 2 -- TreeMenus With Style</strong></em></p>
<p>In <strong>Table 2</strong> Menu 1.0 appears again for comparison. Menus 2.1 
  and 2.2 are drawn using the <strong>AutoStyle</strong> feature. Expand the branches 
  of Menu 2.1 or 2.2 and observe how the text style is different at different 
  levels. The Auto Style feature assigns default CSS styles to the different levels 
  of the menu. Menu 2.1 uses the default styles, while we've assigned a list of 
  user styles for Menu 2.2. </p>
<p>Below is the PHP code that produced Menus 2.1 and 2.2. </p>
<blockquote> 
  <p> 
    <?php
  $mcode = '    // Menu 1.0
    $example010->printMenu();  // The Presentation object already exists, just print it.

    // Menu 2.1
    $menuProperties = array("images"=>"TMimages", "defaultClass"=>"auto");
    $example021 = &new HTML_TreeMenu_DHTMLXL($menu00, $menuProperties);
    $example021->printMenu();
		
    // Menu 2.2
    $menuProperties = array("images"=>"TMimages", "defaultClass"=>"auto",
                            "autostyles"=>array("smalltextBold", "smallitalic", "smalltext") );
    $example022 = &new HTML_TreeMenu_DHTMLXL($menu00, $menuProperties);
    $example022->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
    &nbsp; </p>
</blockquote>
<p>First of all, we continue to use the same TreeMenu object for all these menus. 
  We already have a Presentation object for Menu 1.0, so we just used it to generate 
  another menu. For Menu 2.1, notice that the property <strong>defaultClass</strong> 
  is set to <strong>auto</strong> when we create the Presentation object. This 
  sets the default CSS class for every node. This could be the name of an actual 
  CSS class, but the word &quot;auto&quot; is special: it means that the actual 
  CSS class used for each node will be selected automatically, based on that node's 
  level in the tree.</p>
<p>This should become more clear from Menu 2.2. This time, besides setting the 
  defaultClass property, we also set the <strong>autostyles</strong> property. 
  Autostyles controls the list of automatic styles used in Menu 2.2.</p>
<p>By default, autostyles lists four menu level styles that are defined in the 
  standard TreeMenuXL style sheet: <tt>tmenu0text</tt>, <tt>tmenu1text</tt>, <tt>tmenu2text</tt> 
  and <tt>tmenu3text</tt>. Why only four? What happens if one has five levels? 
  Menu levels deeper than the number of auto styles are given the deepest defined 
  auto style (<tt>tmenu3text</tt> in this case).</p>
<p>The standard HTML_TreeMenu style sheet is shown below. It can be included either 
  as a link or directly in your document. The style sheet includes control over 
  link appearance as well. Since all menu items are links, this can be important.</p>
<blockquote> 
  <pre>
<?php 
  readfile('TreeMenu.css');
?>&nbsp;
</pre>
</blockquote>
<h3><a name="noicons"></a>TreeMenus Without Icons</h3>
<p>It is possible to specify the icon associated with each menu item, or no icon 
  at all. So far, all of our example menus have been generated with a folder icon 
  (<img src="TMimages/folder.gif" alt="folder icon" width="20" height="20" align="absmiddle"> 
  or <img src="TMimagesAlt/folder.gif" alt="folder icon" width="20" height="20" align="absmiddle">)assigned 
  to each item, but this is very easy to change.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 1.0<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles</strong></td>
    <td><strong>Menu 3.1<br>
      No Icons /<br>
      Standard Images /<br>
      Default Styles</strong></td>
    <td><strong>Menu 3.2<br>
      No Icons /<br>
      Alt Images /<br>
      Default Styles</strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php 
        $example010->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php 
        // Menu 3.1
        $example031 = &new HTML_TreeMenu_DHTMLXL($menu03, array("images"=>"TMimages"));
        $example031->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php 
        // Menu 3.2
        $example032 = &new HTML_TreeMenu_DHTMLXL($menu03, array("images"=>"TMimagesAlt"));
        $example032->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 3 -- TreeMenus With No Icons</strong></em></p>
<p><strong>Table 3</strong> shows TreeMenus with no icons (Menu 1.0 is included 
  again for comparison). As you can see, &quot;no icons&quot; means here that 
  there is no longer a little folder icon <img src="TMimages/folder.gif" alt="folder icon" width="20" height="20" align="absmiddle"> 
  associated with each item. Unless you're using an older browser, you'll notice 
  that the menus still include the navigation graphics, such as<img src="TMimagesAlt/plus.gif" alt="plus icon" width="20" height="20" align="absmiddle">and<img src="TMimagesAlt/minus.gif" alt="minus icon" width="20" height="20" align="absmiddle">. 
  We shall see later on how to eliminate all the navigation graphics.</p>
<p>The PHP code for Menus 3.1 and 3.2 is shown below. We first have to create 
  a new TreeMenu object where each node has no icon -- icons are properties of 
  the TreeNodes.</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Menu03 -- The nodes are created without icons.
  $nodeProperties = array("cssClass"=>"auto");
  $menu03  = new HTML_TreeMenuXL();
  $node03  = new HTML_TreeNodeXL("INBOX", "#", $nodeProperties);
  $nx = &$node03->
    addItem(new HTML_TreeNodeXL("A Folder", "#link1", $nodeProperties));
  $nx = &$nx->
      addItem(new HTML_TreeNodeXL("Nested Folder", "#link2", $nodeProperties));
  $nx = &$nx->
        addItem(new HTML_TreeNodeXL("Deeper ...", "#link3", $nodeProperties));
  $nx = &$nx->
          addItem(new HTML_TreeNodeXL("... and Deeper", "#link4", $nodeProperties));

  $node03->addItem(new HTML_TreeNodeXL("deleted-items", "#link5", $nodeProperties));
  $node03->addItem(new HTML_TreeNodeXL("sent-items",    "#link6", $nodeProperties));
  $node03->addItem(new HTML_TreeNodeXL("drafts",        "#link7", $nodeProperties));	
  $node03->addItem(new HTML_TreeNodeXL("spam",          "#link8", $nodeProperties));	
  
  $menu03->addItem($node03);
  $menu03->addItem(new HTML_TreeNodeXL("My Stuff",      "#link9", $nodeProperties));
  $menu03->addItem(new HTML_TreeNodeXL("Other Stuff",   "#link10", $nodeProperties));
  $menu03->addItem($node03);
	
  // Menu 3.1
  $example031 = &new HTML_TreeMenu_DHTMLXL($menu03, array("images"=>"TMimages"));
  $example031->printMenu();

  // Menu 3.2
  $example032 = &new HTML_TreeMenu_DHTMLXL($menu03, array("images"=>"TMimagesAlt"));
  $example032->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<p>Comparing this code to the tree creation code for Menu 1.0 and other previous 
  menus, you should notice that the <strong>icon</strong> property has <em>not</em> 
  been set in <tt>$nodeProperties</tt> and is therefore not set in each TreeNode 
  as it is created. If <strong>icon</strong> is not set, or is null, then no icon 
  appears for that node. </p>
<h3><a name="rigid"></a>Rigid and Expanded TreeMenus</h3>
<p>Sometimes one does not want the menu to be expandable and collapsible. I call 
  such static menus <em><strong>Rigid</strong></em>, and introduced them as another 
  extension to the original package. In fact, it is possible to generate such 
  a menu entirely on the server -- it does not require any JavaScript on the client. 
  In TreeMenu 1.1 Richard Heyes added a feature to the JavaScript that achieves 
  the same result, but which does depend on JavaScript. Since I had already written 
  the code to statically generate the menu on the server, you now have your choice 
  between the two methods. </p>
<p>Another option is an <strong>Expanded</strong> menu, which is still dynamic, 
  but which is fully expanded when it first appears. It's not clear whether this 
  has any practical value...</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 4.1<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles /<br>
      Expanded </strong></td>
    <td><strong>Menu 4.2<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles /<br>
      Not Dynamic</strong></td>
    <td><strong>Menu 4.3<br>
      Folder Icon /<br>
      Standard Images /<br>
      No Styles /<br>
      Rigid </strong></td>
    <td><strong>Menu 4.4<br>
      Folder Icon /<br>
      Alt Images /<br>
      No Styles /<br>
      Rigid </strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php         // Menu 4.1
        $example041 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages", "expanded"=>true, "defaultClass"=>"smalltext"));
        $example041->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php         // Menu 4.2
        $example042= &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages", "isDynamic"=>false, "defaultClass"=>"smalltext"));
        $example042->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php         // Menu 4.3
        $example043 = &new HTML_TreeMenu_RigidXL($menu00, array("images"=>"TMimages", "defaultClass"=>"smalltext"));
        $example043->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php         // Menu 4.4
        $example044 = &new HTML_TreeMenu_RigidXL($menu00, array("images"=>"TMimagesAlt", "defaultClass"=>"smalltext"));
        $example044->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 4 -- Rigid and Expanded TreeMenus</strong></em></p>
<p>In <strong>Table 4</strong> above, Menu 4.1 is our original Menu 1.0, now set 
  to be <em><strong>Expanded</strong></em>. It appears fully expanded, but still 
  has navigation graphics and can be collapsed.</p>
<p>Menu 4.2 is the same menu again, but this time with the property <em><strong>isDynamic</strong> 
  set to <strong>false</strong></em>. This causes the client JavaScript to produce 
  a rigid menu. </p>
<p>Menus 4.3 and 4.4 are also rigid, but they are produced using a different presentation 
  class: <strong>HTML_TreeMenu_RigidXL</strong>. There should be no difference 
  in the appearance of Menu 4.2 and Menu 4.3.</p>
<p>The PHP code which produced these menus is as follows:</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Menu 4.1
  $example041 = &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages", "expanded"=>true, "defaultClass"=>"smalltext"));
  $example041->printMenu();

  // Menu 4.2
  $example042= &new HTML_TreeMenu_DHTMLXL($menu00, array("images"=>"TMimages", "isDynamic"=>false, "defaultClass"=>"smalltext"));
  $example042->printMenu();

  // Menu 4.3
  $example043 = &new HTML_TreeMenu_RigidXL($menu00, array("images"=>"TMimages", "defaultClass"=>"smalltext"));
  $example043->printMenu();

  // Menu 4.4
  $example044 = &new HTML_TreeMenu_RigidXL($menu00, array("images"=>"TMimagesAlt", "defaultClass"=>"smalltext"));
  $example044->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
    &nbsp; </p>
</blockquote>
<p>One other thing to observe from Table 4 is the use of <strong>defaultClass</strong> 
  to make all the text smaller.</p>
<h3><a name="advanced_spacing" id="advanced_spacing"></a>Controlling Indenting 
  and Vertical Spacing</h3>
<h4>The Problem: Embedded Images</h4>
<p>You might have noticed that all our menus up until now have the same vertical 
  spacing. The line for each menu entry is the same height no matter how small 
  the font is. The reason is that, up until now, each of our menu entries has 
  contained 20x20 graphic elements on the line, sometimes invisibly. </p>
<p>All of the folder icons, navigation buttons, line elements, and even the &quot;invisible 
  lines&quot; in the Alt Images are 20x20 images. But if we can finally remove 
  all graphic elements, the line spacing will be determined by the style and text 
  content for that line.</p>
<p>The same observation can be made about the indenting of each line. Until now, 
  each menu line is indented by some multiple of 20 pixels, since the indenting 
  is controlled by the number of graphic elements at the start of each line. If 
  we want any different indenting we will either have to remove the graphic elements 
  or find a way to use different sizes.</p>
<h4>Getting Rid of Navigation Images</h4>
<p>We already know that icons are only included if we ask for them. And we can 
  easily get ride of the navigation buttons and lines by setting the &quot;images&quot; 
  property to null. But watch out! If your menu has no nav buttons then you won't 
  be able to expand it. So you should generate a rigid menu. </p>
<p>So, to entirely eliminate graphics from a tree menu it should have the following 
  properties:</p>
<ul>
  <li>rigid (either using HTML_TreeMenu_RigidXL or using 'isDynamic'=&gt;false 
    with HTML_TreeMenu_DHTMLXL)</li>
  <li>no icon (&quot;icon&quot;=&gt;null)</li>
  <li>no navigation elements (&quot;images&quot;=&gt;null)</li>
</ul>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 5.1<br>
      No Icons /<br>
      Standard Images /<br>
      Default Styles /<br>
      Rigid </strong></td>
    <td><strong>Menu 5.2<br>
      No Icons /<br>
      Alt Images /<br>
      Default Styles /<br>
      Rigid</strong></td>
    <td><strong>Menu 5.3<br>
      No Icons /<br>
      XL Images /<br>
      Default Styles /<br>
      Rigid</strong></td>
    <td><strong>Menu 5.4<br>
      No Icons /<br>
      No Images /<br>
      Default Styles /<br>
      Rigid </strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php         // Menu 5.1
        $example051 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>"TMimages"));
        $example051->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php         // Menu 5.2
        $example052 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>"TMimagesAlt"));
        $example052->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php         // Menu 5.3
        $menuProperties = array("images"=>"TMimagesXL", "lineImageHeight"=>16, "lineImageWidth"=>10);
        $example053 = &new HTML_TreeMenu_RigidXL($menu03, $menuProperties);
        $example053->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php        // Menu 5.4
        $example054 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>""));
        $example054->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 5 -- Rigid TreeMenus With No Icons</strong></em></p>
<p><strong>Table 5</strong> shows several rigid menus with no icons, showing the 
  effect of various different line graphics sets. <em>Only <strong>Menu 5.4</strong> 
  is complete free of graphic images.</em> Notice that the line spacing is controlled 
  by the font size for each menu entry. The indenting, in the absence of any graphics, 
  is done with two &quot;<em><strong>&amp;nbsp;</strong></em>&quot; entities for 
  each level. </p>
<p>In <strong>Menu 5.1</strong> you can see the line graphics that are part of 
  the standard images. These 20x20 images control the line spacing and the indenting. 
  <strong>Menu 5.2</strong> has the same line spacing and indenting, controlled 
  by the invisible 20x20 Alt images. </p>
<p><strong>Menu 5.3</strong>, however, introduces something new. It uses a set 
  of &quot;XL Images&quot; and introduces a new set of properties for controlling 
  image size: <strong>lineImageWidth</strong> and <strong>lineImageHeight</strong>. 
</p>
<p>Here is the code for producing all the menus in Table 5.</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Menu 5.1
  $example051 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>"TMimages"));
  $example051->printMenu();

  // Menu 5.2
  $example052 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>"TMimagesAlt"));
  $example052->printMenu();

  // Menu 5.3
  $menuProperties = array("images"=>"TMimagesXL", "lineImageHeight"=>16, "lineImageWidth"=>10);
  $example053 = &new HTML_TreeMenu_RigidXL($menu03, $menuProperties);
  $example053->printMenu();

  // Menu 5.4
  $example054 = &new HTML_TreeMenu_RigidXL($menu03, array("images"=>""));
  $example054->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<p>Take a look at the code for Menu 5.3. The property setting <tt>&quot;images&quot;=&gt;&quot;TMimagesXL&quot;</tt> 
  selects the &quot;XL Images&quot; set. The property settings <tt>&quot;lineImageHeight&quot;=&gt;16, 
  &quot;lineImageWidth&quot;=&gt;10</tt> set the sizes that will be used for all 
  the navigation images.</p>
<p>The XL Images set includes transparent 1x1 GIF spacers for all the navigation 
  images. These can be used at any size, so one has complete freedom in setting 
  their height and width. In Menu 5.3 the line images are set to be 10 pixels 
  wide and 16 pixels high. The result is a menu in which the minimum line height 
  is 16 pixels, and the indentation width is 10 pixels.</p>
<h3><a name="advanced_linkselect"></a>LinkSelect, User Images and User Styles</h3>
<h4>User Images</h4>
<p>They don't appear in Menu 5.3, but included in the &quot;XL Images&quot; are 
  a set of 12x9 navigation buttons (12 pixels wide, 9 pixels high). By &quot;navigation 
  button&quot; I mean the <img src="/MenuTools/HTML_TreeMenuXL/TMimagesXL/plus.gif" width="12" height="9" align="absmiddle"> 
  and <img src="/MenuTools/HTML_TreeMenuXL/TMimagesXL/minus.gif" width="12" height="9" align="absmiddle"> 
  buttons. Navigation button sizes are also controlled using <strong>lineImageWidth</strong> 
  and <strong>lineImageHeight</strong>, so 12x9 will be the correct settings if 
  you want to use these particular images in a dynamic menu. If you use the wrong 
  size you will get distortion, like this: <img src="/MenuTools/HTML_TreeMenuXL/TMimagesXL/plus.gif" width="16" height="16" align="absmiddle">.</p>
<p> The important point here is not really the sizes of the XL Images, but that 
  you can create your own images. You just have to pay attention to the size.</p>
<h4>LinkSelect</h4>
<p>Another new feature in TreeMenuXL is <em><strong>LinkSelect</strong></em> which 
  allows you to dynamically expand and highlight one (or more) of the menu nodes. 
  Set the <strong>linkSelectKey</strong> property to a string that will match 
  one of the link targets in the menu. Then any menu item with a link target that 
  matches the <strong>linkSelectKey</strong> value will be highlighted and its 
  branch will be expanded. <strong>linkSelectKey</strong> can also be set to an 
  array of values.</p>
<p>We have already discussed User Styles and given an example in Menu 2.2. Here 
  they are combined with the other features to produce a custom menu.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Menu 6.1<br>
      No Icons /<br>
      XL Images /<br>
      Default Styles</strong></td>
    <td><strong>Menu 6.2<br>
      No Icons /<br>
      XL Images /<br>
      Default Styles /<br>
      LinkSelect </strong></td>
    <td><strong>Menu 6.3<br>
      No Icons /<br>
      XL Images /<br>
      User Styles /<br>
      LinkSelect </strong></td>
  </tr>
  <tr> 
    <td valign="top"> 
      <?php         // Menu 6.1
        $menuProperties = array("images"=>"TMimagesXL", 
                                "lineImageHeight"=>9, "lineImageWidth"=>12 );
        $example061 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
        $example061->printMenu();
      ?>
    </td>
    <td valign="top"> 
      <?php       // Menu 6.2
      $menuProperties = array("images"=>"TMimagesXL", 
                              "lineImageHeight"=>9, "lineImageWidth"=>12,
                              "linkSelectKey"=>"#link5" );
      $example062 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
      $example062->printMenu();
		  $menu03->unsetProperties( array("selected", "expanded") );
      ?>
    </td>
    <td valign="top"> 
      <?php       // Menu 6.3
      $menuProperties = array("images"=>"TMimagesXL",
                              "lineImageHeight"=>9, "lineImageWidth"=>12,
                              "linkSelectKey"=>"#link3",
                              "autostyles"=>array("smalltextBold", "smallitalic", "smalltext", "xsmalltext") );
      $example063 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
      $example063->printMenu();
		  $menu03->unsetProperties( array("selected", "expanded") );
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 6 -- Dynamic TreeMenus with LinkSelect, User 
  Images and User Styles</strong></em></p>
<p>All the menus in <strong>Table 6</strong> illustrate the use of the XL images. 
  In each case <strong>lineImageWidth</strong> and <strong>lineImageHeight</strong> 
  are set to 12 and 9 respectively to match the size of the navigation icons. 
  Menus 6.2 and 6.3 use <strong>LinkSelect</strong> to expand and highlight certain 
  menu entries.</p>
<p>The full code for Table 6 is shown below. This also shows how to &quot;unset&quot; 
  certain menu properties.</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Menu 6.1
  $menuProperties = array("images"=>"TMimagesXL", 
                          "lineImageHeight"=>9, "lineImageWidth"=>12 );
  $example061 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
  $example061->printMenu();

  // Menu 6.2
  $menuProperties = array("images"=>"TMimagesXL", 
                          "lineImageHeight"=>9, "lineImageWidth"=>12,
                          "linkSelectKey"=>"#link5" );
  $example062 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
  $example062->printMenu();
  $menu03->unsetProperties( array("selected", "expanded") );

  // Menu 6.3
  $menuProperties = array("images"=>"TMimagesXL",
                          "lineImageHeight"=>9, "lineImageWidth"=>12,
                          "linkSelectKey"=>"#link3",
                          "autostyles"=>array("smalltextBold", "smallitalic", "smalltext", "xsmalltext") );
  $example063 = &new HTML_TreeMenu_DHTMLXL($menu03, $menuProperties);
  $example063->printMenu();
  $menu03->unsetProperties( array("selected", "expanded") );
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<p>The TreeMenu member function <tt>unsetProperties()</tt> is used in Table 6 
  for the first time. But you will probably never need it. I use it here to clean 
  up the TreeNodes after the effect of LinkSelect so I can use the TreeMenu again 
  in these examples.</p>
<h3><a name="listbox"></a>Listbox Menus</h3>
<p>I became interested in <strong>HTML_TreeMenu</strong> because I wanted to replace 
  my previous menu system. One feature of my old code was that, in addition to 
  a tree structured menu, I could use it to generate a Listbox to perform the 
  same function. I like to use these Listboxes in the page footer, and sometimes 
  elsewhere. As of HTML_TreeMenu 1.1, a listbox presentation class is included 
  in the package. However there were still some features that I wanted which it 
  lacked, and so I have an extended HTML_TreeMenu_ListboxXL presentation class.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Listbox 1<br>
      Standard Listbox: HTML_TreeMenu_Listbox</strong></td>
  </tr>
  <tr> 
    <td> 
      <?php 
      $lbox01 = &new HTML_TreeMenu_Listbox($menu00);
      $lbox01->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 7 -- Standard Listbox</strong></em></p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td colspan="2"><strong>Listbox 2<br>
      Extended Listbox: HTML_TreeMenu_ListboxXL</strong></td>
  </tr>
  <tr> 
    <td class="smalltext">Default Listbox Style Class (tmlistbox)</td>
    <td> 
      <?php 
      $lbox021 = &new HTML_TreeMenu_ListboxXL($menu00);
      $lbox021->printMenu();
      ?>
    </td>
  </tr>
  <tr> 
    <td class="smalltext">No Listbox Style Class</td>
    <td> 
      <?php 
      $lbox022 = &new HTML_TreeMenu_ListboxXL($menu00, array('cssClass'=>""));
      $lbox022->printMenu();
      ?>
    </td>
  </tr>
  <tr> 
    <td class="smalltext">User Listbox Style Class (xsmalltext)</td>
    <td> 
      <?php 
      $lbox023 = &new HTML_TreeMenu_ListboxXL($menu00, array('cssClass'=>'xsmalltext'));
      $lbox023->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 8 -- Extended Listbox with Styles</strong></em></p>
<p align="left">All of the Listboxes in Tables 7 and 8 are generated from the 
  same menu object as Menu 1.0. But a new Presentation class is used.. <strong>Table 
  7</strong> uses the standard TreeMenu listbox while <strong>Table 8</strong> 
  uses the XL extended Listbox class. The code is shown below:</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Listbox 1
  $lbox01 = &new HTML_TreeMenu_Listbox($menu00);
  $lbox01->printMenu();

  // Listbox 2.1
  $lbox021 = &new HTML_TreeMenu_ListboxXL($menu00);
  $lbox021->printMenu();

  // Listbox 2.2
  $lbox022 = &new HTML_TreeMenu_ListboxXL($menu00, array("cssClass"=>""));
  $lbox022->printMenu();

  // Listbox 2.3
  $lbox023 = &new HTML_TreeMenu_ListboxXL($menu00, array("cssClass"=>"xsmalltext"));
  $lbox023->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
    &nbsp; </p>
</blockquote>
<p align="left">The current advantages of the XL listbox are that it offers control 
  over the CSS class within the form, supports pre-selection of an option, and 
  allows a bit more flexibility in the appearance of the options themselves. Some 
  or all of these features may migrate into the standard class in the future.</p>
<h4>Why the 'Go' Button? Why not use 'onChange'? </h4>
<p>Someone will ask, &quot;Why the 'Go' button? Why not use 'onChange' and save 
  a click?&quot; The reason is that onChange in select boxes is often a disaster 
  for people with wheel mice. Just imagine scrolling down a page and suddenly 
  twirling the selection inadvertently. Then off you go. Just forget about it.</p>
<h4>Listboxes With Bullets</h4>
<p>The XL listbox class supports a bullet format within the list. To use it, set 
  the property <strong>useBullets</strong> to true. You may wish to also set <strong>indentNum</strong> 
  to 1 in order to avoid excessive indenting.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Listbox 3<br>
      Listbox With Bullets</strong></td>
  </tr>
  <tr> 
    <td> 
      <?php 
      $mprops = array("useBullets"=>true, "indentNum"=>1);
      $lbox03 = &new HTML_TreeMenu_ListboxXL($menu00, $mprops);
      $lbox03->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 9 -- Extended Listbox</strong></em></p>
<p>Below is the code for <strong>Table 9</strong>:</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '      $mprops = array("useBullets"=>true, "indentNum"=>1);
      $lbox03 = &new HTML_TreeMenu_ListboxXL($menu00, $mprops);
      $lbox03->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<p>The list of bullet formats is set using property <strong>bulletStyles</strong>, 
  an array. For more information see the property descriptions below.</p>
<h4>Pre-Selecting Listbox Options</h4>
<p>When I use a listbox for navigation I like to preselect the option corresponding 
  to my current location. The XL Listbox class will do this using the <strong>linkSelectKey</strong> 
  property, just like the TreeMenu presentation class. To illustrate, here's a 
  more useful example: the Table of Contents for this document.</p>
<table border="1" align="center" cellpadding="4" cellspacing="1">
  <tr> 
    <td><strong>Listbox Menu 4<br>
      Table of Contents</strong></td>
  </tr>
  <tr> 
    <td> 
      <?php       // Listbox 4
      $mprops = array("useBullets"=>true, "indentNum"=>1, "linkSelectKey"=>"#listbox");
      $lbox04 = &new HTML_TreeMenu_ListboxXL($pgmenu, $mprops);
      $lbox04->printMenu();
      ?>
    </td>
  </tr>
</table>
<p align="center"><em><strong>Table 10 -- Table of Contents Listbox, using linkSelectKey</strong></em></p>
<p>Try it! The code Listbox 4 is below:</p>
<blockquote> 
  <p> 
    <?php 
  $mcode = '  // Listbox 4
  $mprops = array("useBullets"=>true, "indentNum"=>1, "linkSelectKey"=>"#listbox");
  $lbox04 = &new HTML_TreeMenu_ListboxXL($pgmenu, $mprops);
  $lbox04->printMenu();
'; 
  highlight_string( '<'."?php\n" . $mcode . '?'.">\n" ); 
?>
  </p>
</blockquote>
<h4>ListboxXL Properties</h4>
<dl>
  <dt><strong>cssClass</strong></dt>
  <dd>The text style of the listBox is controlled by the property <strong>cssClass</strong>, 
    which by default is set to &quot;tmlistbox&quot;. cssClass will be used to 
    set the class of the SELECT and INPUT elements. Note: I've usually found it 
    necessary to adjust the font sizes on different browsers to get a consistent 
    appearance. Set cssClass to the empty string if you don't want any classes 
    set.<br>
    (XL only)</dd>
  <dt><strong>indentChar</strong></dt>
  <dd>Actually a string, not just a character. It will be used for indentation 
    on each line. Defaults to &quot;&amp;nbsp;&quot;<br>
    (standard)</dd>
  <dt><strong>indentNum</strong></dt>
  <dd>The number of times indentChar is repeated for each indentation level. So, 
    <tt>array(&quot;indentChar&quot;=&gt;&quot;&amp;nbsp;&quot;, &quot;indentNum&quot;=&gt;2)</tt> 
    would result in each indentation level being two spaces (<tt>&amp;nbsp;&amp;nbsp;</tt>). 
    Default value is 2.<br>
    (standard)</dd>
  <dt><strong>promoText</strong></dt>
  <dd>If set, this text will appear as the first option in the list. In the standard 
    listbox class this defaults to &quot;Select...&quot;. In the XL class this 
    defaults to null. <br>
    (standard)</dd>
  <dt><strong>bulletStyles</strong></dt>
  <dd>An array of strings that can be used as part of the leading in addition 
    to the indentChar. This allows you to put different sorts of bullets in front 
    of menu entries at different levels. Default is currently <tt>array('', '&amp;#8226; 
    ', '-- ', '&amp;nbsp;- ', '&amp;nbsp;')</tt>. <br>
    (XL only)</dd>
  <dt><strong>useBullets</strong></dt>
  <dd>True/false, controls whether or not to use the bulletStyles. Default is 
    false. <br>
    (XL only)</dd>
  <dt><strong>linkSelectKey</strong></dt>
  <dd>Works in much the same way as for the TreeMenu presentation classes. Matching 
    menu nodes (ideally there should be only one match) will have the &quot;selected&quot; 
    attribute added to their OPTION element, so that it will be pre-selected in 
    the listbox.<br>
    (XL only)</dd>
</dl>
<p>&nbsp;</p>
<h2><a name="history" id="history"></a>TreeMenuXL History</h2>
<h3><a name="xl11"></a>TreeMenuXL 1.1 (1.0.4/XL1.1)</h3>
<p>When I began working with TreeMenu 1.0.4, I found the following issues:</p>
<blockquote> 
  <ul>
    <li>It made Netscape 4.x browsers very sick.</li>
    <li>Use of multiple menus on a page was clumsy.</li>
    <li>Multiple copies on a page of the same menu were not supported.</li>
    <li>Very limited control over menu appearance.</li>
  </ul>
</blockquote>
<p>I wanted greater built-in control over the menu appearance, and I wanted to 
  produce different kinds of menu representations, such as listboxes, in addition 
  to the trees. Part of my solution to the Netscape 4.x problem was to add the 
  capability of statically generating menus, instead of depending entirely on 
  client-side JavaScript for this function.</p>
<p>In addition to providing solutions for these problems, TreeMenuXL 1.1 offered 
  a number of new features: The Style extension for using CSS classes with menu 
  nodes, Menus without images, Listbox Menus, Rigid and Expanded menus, the property 
  list interface, image size control, expansion and highlighting of selected branches 
  (linkSelect). </p>
<h3><a name="xl12"></a>TreeMenuXL 2.0 (1.1.0/XL2.0)</h3>
<p> Richard Heyes' release of TreeMenu 1.1.0 contains solutions for most of the 
  issues that I had with TreeMenu 1.0.4, and in several cases adopts my ideas 
  (while generally improving on the implementation). This greatly simplifies the 
  code for TreeMenuXL, and so the XL 2.0 release is a reimplementation using the 
  new TreeMenu 1.1.0 base.</p>
<p>XL 2.0 still offers a number of benefits over the current TreeMenu 1.1.0, including 
  Menu-independent assignment of Presentation properties, more usable Style interface, 
  menus without images, more-flexible listbox menus, statically generated Rigid 
  menus, flexible node creation interface using both positional parameters and 
  property list array, image size control, expansion and highlighting of selected 
  branches (linkSelect).</p>
<h3><a name="summary_of_new_features" id="summary_of_new_features"></a>Summary 
  of New Features in TreeMenuXL</h3>
<p><em>This section is current as of TreeMenu 1.0.4 and TreeMenuXL 1.1. It has 
  not yet been entirely updated for TreeMenu 1.1.0 and TreeMenuXL 2.0.</em></p>
<p>What features are in TreeMenuXL that aren't in the current TreeMenu release?</p>
<dl>
  <dt><strong>Styles for Menu Nodes</strong></dt>
  <dd>The <strong>Style</strong> extension supports the use of style sheets (CSS) 
    to control the appearance of menu entries. It has an automatic mode that assigns 
    standard styles to different levels of the menu tree. It possible to override 
    the standard styles in a variety of ways.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Menus without Images</strong></dt>
  <dd>In its original form, HTML_TreeMenu always uses 20x20 graphic elements in 
    the generated menus, though they may be invisible. This constrains the layout 
    of menu. HTML_TreeMenuXL currently provides <em>limited</em> support for menus 
    without images.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Listbox Menus</strong></dt>
  <dd>A new output option is available for statically generating HTML listboxes 
    from a menu object. The extended Listbox class offers control over the CSS 
    class within the form, supports pre-selected options, and allows greater flexibility 
    in the appearance of the options themselves.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Rigid and Expanded Menus</strong></dt>
  <dd>My solution to the Netscape 4.x problem was to perform server-side browser 
    detection and generate static menus on the server for older browsers. Once 
    the code was in place for doing this, it was easy to add the <strong>Rigid 
    Menu</strong> feature. I have also extended the Expanded Branch function in 
    the original package so that it's easier to create a dynamic menu that starts 
    out fully expanded.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Property List Interface</strong></dt>
  <dd>Along with these extensions has come a proliferation of new menu properties 
    that need to be controlled. Rather than multiply the argument lists of the 
    class functions, most behavior is now controlled using property lists.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Image Size Control</strong></dt>
  <dd>The sizes of line and icon graphics is no longer limited to 20x20.</dd>
  <dt>&nbsp;</dt>
  <dt><strong>Expansion and Highlighting of Selected Branches (LinkSelect)</strong></dt>
  <dd>HTML_TreeMenuXL will automatically expand the branches containing nodes 
    that match certain criteria (for example, of the current page), and can highlight 
    the selected nodes.</dd>
  <dt>&nbsp;</dt>
</dl>
<h2></h2>
<h2><a name="reference"></a>HTML_TreeMenu Reference</h2>
<p><em>To Be Added</em>... Intended to be a concise summary of the interface and 
  property settings.</p>
<h2><a name="thingstodo"></a>Things To Do</h2>
<p>This section is my personal list of further work to be done on my version of 
  the HTML_TreeMenu package. Remember, Richard Heyes is the original author and 
  maintainer of HTML_TreeMenu, and he will undoubtedly have different priorities. 
  No assumptions should be made regarding when or if any of these enhancements 
  will be completed, or when they will be merged into Heyes' official version 
  of this package.</p>
<ul>
  <li><tt>lineImageHeight</tt> and <tt>lineImageWidth</tt> might be renamed <tt>navImageHeight</tt> 
    &amp; <tt>-Width</tt>.</li>
  <li>Replace current <tt>images</tt> property (image directory) with two properties, 
    one for navigation graphics and one for icons.</li>
  <li>Currently, <tt>HTML_TreeMenu</tt> does not generate validated HTML. Need 
    to replace the &lt;nobr&gt;...&lt;/nobr&gt; tag and add alt strings to all 
    images.</li>
  <li>Document the <strong>brOK</strong> property.</li>
  <li>Write the Reference section.</li>
  <li>This page is kind of long. Could be split into a multi-page document.</li>
  <li><strong><em>Done</em></strong><em> (XL1.0)</em> Support the use of different 
    style rules for different menus on the same page.</li>
  <li><em><strong><em>Done</em></strong> (XL1.1) </em>Support the use of icons 
    and navigation images that are sizes other than 20x20. 
    <ul>
      <li>Provide an image set that's smaller than 20x20.</li>
      <li>Replace the blank images in 'TMimagesAlt' by 1x1 spacer images.</li>
    </ul>
  </li>
  <li><em><strong>Done</strong> (XL1.1)</em> Menu generation as an HTML Listbox. 
  </li>
  <li> <em><strong>Done</strong></em> <em>(XL1.1)</em> Change the constructor 
    and printMenu interface to use property lists instead of the current argument 
    lists. </li>
  <li><em><strong>Done</strong> (Richard did this in TreeMenu 1.1)</em> Currently 
    the menu tree structure and the menu representation are handled by the same 
    class (HTML_TreeMenuXL). I'm considering separating these two functions, the 
    way <strong>phpNav</strong> does. So one would first create an object that 
    represents the tree structure for a menu, and then use a separate object to 
    generate a particular type (e.g. a collapsible tree, a list box, or something 
    else) of menu.</li>
  <li><em><strong>Done</strong></em> <em>(XL2.0)</em> Provide a way to modify 
    the leading for items in Listbox menus.</li>
  <li><em><strong>Done</strong></em> <em>(no longer necessary as of TreeMenu 1.1)</em> 
    Merge class <tt>HTML_TreeMenuSafe</tt> into the base class <tt>HTML_TreeMenu</tt>.</li>
</ul>
<p>Want to suggest an enhancement? Feel free, I don't bite. <a href="mailto:cchapin@chipchapin.com?subj=TreeMenu_Suggestion">Send 
  me mail</a>. I will try to give it serious consideration.</p>
<h2><a name="sourcecode"></a>HTML_TreeMenuXL Source Code</h2>
<script language="JavaScript" type="text/JavaScript">
  <!--
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
  if(popUpWin)
  {
    if(!popUpWin.closed) popUpWin.close();
  }
  popUpWin = open(URLStr, 'srcWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=yes,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
	return popUpWin;
}
  -->
</script>
<form action="showsource.php" method="post" name="sourceform" target="srcWin"
  onSubmit="MM_callJS('popUpWindow(\'\',10,10,700,400)'); return true;">
  <p>Click here to see the source code for <em>this</em> page in a new window:<br>
    <br>
    &nbsp;&nbsp; 
    <input type="submit" name="Submit" value="View Example Source Code">
  </p>
</form>
<p>Click the link to download <strong>HTML_TreeMenuXL</strong>:</p>
<ul>
  <li>2002-12-02 (1.1.0/XL2.0.2) <a href="HTML_TreeMenuXL-2.0.2.tgz">HTML_TreeMenuXL-2.0.2.tgz</a> 
    (based on TreeMenu 1.1.0)</li>
</ul>
<p>Archive Versions:</p>
<ul>
  <li>2002-11-15 (1.1.0/XL2.0.1) <a href="HTML_TreeMenuXL-2.0.1.tgz">HTML_TreeMenuXL-2.0.1.tgz</a> 
    (based on TreeMenu 1.1.0)</li>
  <li>2002-11-08 (1.0.4/XL1.1a) <a href="HTML_TreeMenuXL-1.1a.tar.gz">HTML_TreeMenuXL-1.1a.tar.gz</a> 
    (based on TreeMenu 1.0.4)</li>
  <li>2002-11-02 (1.0.4/XL1.0) <a href="HTML_TreeMenu-1.0.4-cc1.0.tar.gz">HTML_TreeMenu-1.0.4-cc1.0.tar.gz</a> 
    (based on TreeMenu 1.0.4)</li>
</ul>
<p>&nbsp;</p>
<!-- InstanceEndEditable -->. 
<table border="0" cellspacing="2" cellpadding="2" width=
      "100%">
  <tr> 
    <td colspan="2"> <hr> </td>
  </tr>
  <tr> 
    <td colspan="2">
  <table width="100%" cellspacing="0" summary="">
        <tr> 
      <td width="88"> <a href=
              "http://validator.w3.org/check?uri=<?php echo $_SERVER['HTTP_HOST'].$PHP_SELF; ?>"> 
        <img src="/images/vh40.png" alt="Valid HTML 4.0!"
              border="0" height="31" width="88"></a> </td>
      <td width="88"> <a href=
              "http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $_SERVER['HTTP_HOST'].$PHP_SELF; ?>"> 
        <img border="0" width="88" height="31" src=
              "/images/vcss.gif" alt="Valid CSS!"></a> </td>
          <td align="RIGHT"> <a href="http://www.chipchapin.com/" target="_blank">Chip's 
            Home Page</a> </td>
    </tr>
  </table>
		</td>
  </tr>
  <tr> 
    <td colspan="2"> <hr> </td>
  </tr>
  <tr> 
    <td valign="top"> <div class="footer"> Copyright &copy; 2002 <a href=
              "mailto:cchapin@chipchapin.com?subject=<?php echo $pgEmailSubj ?>">Chip 
        Chapin</a>,  <a href=
              "http://www.chipchapin.com/" target="_blank">http://www.chipchapin.com</a> 
      </div></td>
    <td align="right"> <div class="date"> 
        Updated 
<?php
  echo strftime("%A %B %d, %Y %T %Z", getlastmod());
  if (false) {
?>
        <!-- #BeginDate format:Am1 -->December 2, 2002<!-- #EndDate -->
<?php } ?>
      </div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
<!-- InstanceEnd --></html>