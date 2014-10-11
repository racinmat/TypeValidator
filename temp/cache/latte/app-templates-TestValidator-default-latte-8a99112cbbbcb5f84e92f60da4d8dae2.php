<?php
// source: C:\wamp\www\TypeValidator\app/templates/TestValidator/default.latte

// prolog Latte\Macros\CoreMacros
list($_b, $_g, $_l) = $template->initialize('8337807393', 'html')
;
// prolog Latte\Macros\BlockMacros
//
// block content
//
if (!function_exists($_b->blocks['content'][] = '_lb3da4e652bf_content')) { function _lb3da4e652bf_content($_b, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("TestValidator:validateCorrect"), ENT_COMPAT) ?>
">Try validating of correct parameters.</a><br>
<a href="<?php echo Latte\Runtime\Filters::escapeHtml($_control->link("TestValidator:validateWrong"), ENT_COMPAT) ?>
">Try validating of incorrect parameters.</a>
<?php
}}

//
// end of blocks
//

// template extending

$_l->extends = empty($_g->extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $_g->extended = TRUE;

if ($_l->extends) { ob_start();}

// prolog Nette\Bridges\ApplicationLatte\UIMacros

// snippets support
if (empty($_l->extends) && !empty($_control->snippetMode)) {
	return Nette\Bridges\ApplicationLatte\UIMacros::renderSnippets($_control, $_b, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return $template->renderChildTemplate($_l->extends, get_defined_vars()); }
call_user_func(reset($_b->blocks['content']), $_b, get_defined_vars()) ; 