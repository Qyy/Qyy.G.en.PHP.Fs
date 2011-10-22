<?php
/**
 * @author G. Qyy <pub-gh@qyy.fr>
 * @copyright Copyright (c) 2011,  G. Qyy
 * @license http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.txt
 *
 * This software is a PHP set of classes whose purpose is to handle files
 * with Oriented Object paradigm. This software has only an educational aim
 * and is not to be used in a production environment.
 *
 * This software is governed by the CeCILL-B license under French law and
 * abiding by the rules of distribution of free software. You can use,
 * modify and/ or redistribute the software under the terms of the CeCILL-B
 * license as circulated by CEA, CNRS and INRIA at the following URL
 * "http://www.cecill.info".
 *
 * As a counterpart to the access to the source code and rights to copy,
 * modify and redistribute granted by the license, users are provided only
 * with a limited warranty and the software's author, the holder of the
 * economic rights, and the successive licensors have only limited liability.
 *
 * In this respect, the user's attention is drawn to the risks associated
 * with loading, using, modifying and/or developing or reproducing the
 * software by the user in light of its specific status of free software,
 * that may mean that it is complicated to manipulate, and that also
 * therefore means that it is reserved for developers and experienced
 * professionals having in-depth computer knowledge. Users are therefore
 * encouraged to load and test the software's suitability as regards their
 * requirements in conditions enabling the security of their systems and/or
 * data to be ensured and, more generally, to use and operate it in the same
 * conditions as regards security.
 *
 * The fact that you are presently reading this means that you have had
 * knowledge of the CeCILL-B license and that you accept its terms.
 */

if (!defined('QYYG_FILE_PATH'))
{
  // For this to work before PHP 5.3.
  // The first test is in case of someone reads this comment and decided to
  // apply it:
  // "http://php.net/manual/en/language.constants.predefined.php#105256".
  // As a reminder, a magic constant CHANGES depending on the context, and the
  // board of the comment creates a real constant.
  // It may therefore be a `__DIR__` constant containing a false value if the
  // code of the comment is called before, in a file who is in another
  // directory and if the PHP version is < 5.3.
  if (
    (defined('__DIR__') && __DIR__ != dirname(__FILE__))
    || !defined('__DIR__'))
  {
    define(
      'QYYG_FILE_PATH',
      dirname(__FILE__).DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR);
  }
  else
  {
    define(
      'QYYG_FILE_PATH',
      __DIR__.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR);
  }
}

require_once(QYYG_FILE_PATH.'Qyy_G_en_Fs.class.php');
require_once(QYYG_FILE_PATH.'Qyy_G_en_Fs_Node.class.php');
require_once(QYYG_FILE_PATH.'Qyy_G_en_Fs_File.class.php');