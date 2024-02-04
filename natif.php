<?php
	defined('_JEXEC') or die('Access deny');

	class plgContentNatif extends JPlugin 
	{
		function onContentPrepare($content, $article, $params, $limit){	
			/*UTILISATION : 
				<a href="monFichier_PDF" data-natif="__DOCUMENTS__/document_natif.odt">LIEN</a>
			*/
			$document = JFactory::getDocument();
			$document->addStyleSheet('plugins/content/natif/style.css');
			
			JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php');
			$customFields = FieldsHelper::getFields('com_users.user', JFactory::getUser(), true);
			$a = FieldsHelper::getFields('com_content.article', $article);					
			$show_natif = $this->params->get('show_natif', '');	
			
			if ($show_natif==1)
			{
				$re = '/(<a.*)(data-natifs?=")(.*)">(.*)<\/a>/m';
				$subst = "$1\">$4</a><a href=\"$3\" target=\"_blank\" class=\"fichier-natif\">NATIF</a>";
			}
			else
			{
				$re = '/(<a.*)(data-natifs?=")(.*)">(.*)<\/a>/m';
				$subst = "$1\">$4</a>";
			}
			$article->text =  preg_replace($re, $subst, $article->text);
		}
	}
?>
