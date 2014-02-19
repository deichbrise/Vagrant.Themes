========================================================================================================================
Documentation for THEMES
========================================================================================================================

:Author: Kay Strobach
:Mail:   typo3@kay-strobach.de


.. contents:: Table of Contents



Understanding Themes
====================

Basicly the EXT:Themes allows to include a static stylesheet into a so called "root template". This way it's easily
possible to allow multiple updateable website themes in a single TYPO3 instance.

As all the themes are packaged as TYPO3 extensions updates can be easily deployed.

Technically this is solved with some hooks, extbase repositories and one XClass to include the modified TSConfig.

Make your own theme
===================

Templating strategy
-------------------

To make your own theme you have to choose a templating engine. You can choose atleast between:

- pure TYPOScript
- fluidcontent and fluidpages
- gridelements
- automaketemplate (not test, but should work)
- any other templating engine which is controllable with TYPOScript (even with userfunctions)

Structure of a theme
--------------------

Extensions containing Themes
............................

A theme is basicly a set of TYPOScript files stored in an extension with some additional meta data.

.. table:: Minimum set of files for a theme

   =================================  ======================================================================
     File                              Function of the file
   =================================  ======================================================================
   ext_emconf.php                      Needed for every extension in TYPO3
   ext_icon.gif                        Icon for the extensionmanager
   Configuration/Theme/constants.ts    contains constants to easily configure a theme
   Configuration/Theme/setup.ts        contains the needed TYPOScript to render the frontend
   Configuration/Theme/tsconfig.ts     contains the PageTS to configure the pagebranch of a selected theme
   =================================  ======================================================================

Additionally there are some files, which are usefull to achieve some higher goals.

.. table:: Other usefull files

   =================================  ======================================================================
     File                              Function of the file
   =================================  ======================================================================
   Resources/Private/*                 contains resources, which are not served to the user
   Resources/Public/*                  contains resources, which are normally served to the user
   Documentation/*                     contains theme documentation
   Configuration/t3jquery.txt          contains the t3jquery configuration
   ext_tables.php                      usually contains backwards compat stuff to use a theme standalone
   Configuration/TypoScript            used for compatibility with ext_tables.php
   =================================  ======================================================================

Themes - the alternative way of shipping
........................................


Kickstarting a theme
--------------------

You may use ext:themes_builder to generate the structure with just a bunch of clicks.

@todo insert more information about the themes_builder here.

Minimal TYPOScript of a theme
-----------------------------

If you want to make a theme with less TYPOScript as possible, you may use fluidcontent and fluidpages to make the
progress easier.
Using this libraries you just need to configure where to find the definitions of pagelayout and elements.

This way you can built layouts with nearly no TYPOScript.

Additionally you may use EXT:themes_fces_fluidcontent_basic to use a big and growing library of usefull content
elements, which can be easily adjusted.

Suggested Extensions and libraries
----------------------------------

.. table:: Suggested extensions and libraries

   ====================================  ======================================================================
    extension key                         use case
   ====================================  ======================================================================
   basictemplate                          an ultra lightweight theme, which is based on pure TYPOScript
   themes_builder                         helper to kickstart a new theme
   themes_fces_fluidcontent_basic         provides some additional and usefall standard fces and pagestructures
   themes adapter_templavoilaframework    provides an adapter to use tv framework skins with themes
   themes_adapter_wordpress               provides an adapter to use wordpress themes with EXT:themes
   themes_settings                        provides an easy to use interface to adjust a theme
   theme_bootstrap                        an example theme
   theme_bootstrap_flatly                 an example theme, which depends on EXT:theme_bootstrap
   ====================================  ======================================================================


Compatibility
=============

Add your own theme model to the repository
-------------------------------------------

You may create your own model for handling special usecases of themes. This way is possible to e.g. use
templavoila_framework skins or similar stuff with themes by simulating the needed libs.

You may find examples in the extension EXT:themes_adapter_templavoilaframework or in EXT:themes_adapter_wordpress.

- https://github.com/typo3-themes/themes_adapter_templavoilaframework
- https://github.com/typo3-themes/themes_adapter_wordpress