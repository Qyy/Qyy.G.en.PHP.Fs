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
 
// TODO: doc
class Qyy_G_en_FileSystem
{
  
  // TODO: doc
  // http://php.net/manual/en/function.file-exists.php
  public static function ThrowExceptionIfNodeDoesNotExists ($name)
  {
    if (!file_exists($name))
    {
      throw new InvalidArgumentException(
        'This node does not exist or permissions are not set correctly: '
          .PHP_EOL
          .'"'.$name.'"',
        404);
    }
  }
  
  // TODO: doc
  // http://php.net/manual/en/function.is-file.php
  public static function ThrowExceptionIfNotFile ($name)
  {
    if (!is_file($name))
    {
      throw new InvalidArgumentException(
        'This node does not seems to be a file: '
          .PHP_EOL
          .'"'.$name.'"',
        400);
    }
  }
}