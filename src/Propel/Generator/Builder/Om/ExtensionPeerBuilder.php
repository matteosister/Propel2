<?php

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

namespace Propel\Generator\Builder\Om;

/**
 * Generates the empty PHP5 stub peer class for user object model (OM).
 *
 * This class produces the empty stub class that can be customized with application
 * business logic, custom behavior, etc.
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 */
class ExtensionPeerBuilder extends AbstractPeerBuilder
{

    /**
     * Returns the name of the current class being built.
     * @return     string
     */
    public function getUnprefixedClassname()
    {
        return $this->getStubObjectBuilder()->getUnprefixedClassname() . 'Peer';
    }

    /**
     * Adds class phpdoc comment and openning of class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {
        $table = $this->getTable();
        $tableName = $table->getName();
        $tableDesc = $table->getDescription();
        $baseClassname = 'Base' . $this->getPeerBuilder()->getClassname();
        $this->declareClassNamespace($this->getPeerBuilder()->getClassname() . ' as ' . $baseClassname, $this->getPeerBuilder()->getNamespace());

        $script .= "

/**
 * Skeleton subclass for performing query and update operations on the '$tableName' table.
 *
 * $tableDesc
 *";
        if ($this->getBuildProperty('addTimeStamp')) {
            $now = strftime('%c');
            $script .= "
 * This class was autogenerated by Propel " . $this->getBuildProperty('version') . " on:
 *
 * $now
 *";
        }
        $script .= "
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class ".$this->getClassname()." extends $baseClassname {
";
    }

        /**
     * Specifies the methods that are added as part of the stub peer class.
     *
     * By default there are no methods for the empty stub classes; override this method
     * if you want to change that behavior.
     *
     * @see        ObjectBuilder::addClassBody()
     */

    protected function addClassBody(&$script)
    {
        // there is no class body
    }

    /**
     * Closes class.
     * @param      string &$script The script will be modified in this method.
     */
    protected function addClassClose(&$script)
    {
        $script .= "
} // " . $this->getClassname() . "
";
        $this->applyBehaviorModifier('extensionPeerFilter', $script, "");
    }


} // ExtensionPeerBuilder
