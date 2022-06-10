<?php

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');

define('VENDOR_DIR', realpath(__DIR__ . '/../vendor'));
define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form');
define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator');
define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge');
define('VIEWS_DIR', realpath(__DIR__ . '/../views/forms'));

// Set up the CSRF Token Manager


// Set up the Validator component
$validator = Validation::createValidator();

// Set up the Translation component
$translator = new Translator('en');
$translator->addLoader('xlf', new XliffFileLoader());
$translator->addResource('xlf', VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');
$translator->addResource('xlf', VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');

$twig = new \Twig\Environment(new Twig\Loader\FilesystemLoader(array(
    VIEWS_DIR,
    VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
)));
$formEngine = new TwigRendererEngine(array(DEFAULT_FORM_THEME),$twig);
$twig->addRuntimeLoader(new FactoryRuntimeLoader([
    FormRenderer::class => function () use ($formEngine) {
        return new FormRenderer($formEngine);
    },
]));

$twig->addExtension(new TranslationExtension($translator));
$twig->addExtension(new FormExtension());

// Set up the Form component
$formFactory = Forms::createFormFactoryBuilder()
    ->addExtension(new ValidatorExtension($validator))
    ->addExtension(new HttpFoundationExtension())
    ->getFormFactory();