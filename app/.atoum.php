<?php
/**
 * @var $runner \mageekguy\atoum\runner
 * @var $script \mageekguy\atoum\configurator
 */

use mageekguy\atoum;
use mageekguy\atoum\report\fields\runner\coverage;

define('PROJECT_NAME', 'sir');
define('TMP_DIR', __DIR__);
define('COVERAGE_TITLE', PROJECT_NAME);
define('COVERAGE_DIRECTORY', TMP_DIR . '/../web/atoum/' . PROJECT_NAME . '_coverage');
define('COVERAGE_WEB_PATH', 'http://api.sir.dev/atoum/' . PROJECT_NAME . '_coverage');
define('AUTOLOAD_CACHE', TMP_DIR . DIRECTORY_SEPARATOR . PROJECT_NAME . '.atoum.cache');

if (false === is_dir(COVERAGE_DIRECTORY)) {
    mkdir(COVERAGE_DIRECTORY, 0777, true);
}

$testDirectories = array(
    'src'
);

$autoloader = atoum\autoloader::get();
$autoloader->setCacheFile(AUTOLOAD_CACHE);

$coverageField = new coverage\html(COVERAGE_TITLE, COVERAGE_DIRECTORY);
$coverageField->setRootUrl(COVERAGE_WEB_PATH);

foreach ($testDirectories as $d) {
    $runner->addTestsFromDirectory($d);
}

$cliReport = $script->addDefaultReport();
$cliReport->addField($coverageField);
