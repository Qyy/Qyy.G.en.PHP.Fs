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
class Qyy_G_en_Fs
{

  /**
   * Throw an Exception in the case of the designated node in the parameter
   * `$name` does not exits.
   * @link http://php.net/manual/en/function.file-exists.php
   * @param string $name <p>
   * Path to the file or directory. <br/>
   * On windows, use `//computername/share/filename` or
   * `\\computername\share\filename` to check files on network shares.
   * <\p>
   */
  public static function ThrowExceptionIfNodeDoesNotExists ($name)
  {
    if (!file_exists($name))
    {
      throw new InvalidArgumentException(
        'This node does not exists or permissions are not set correctly: '
          .PHP_EOL
          .'"'.$name.'"',
        404);
    }
  }
  
  /**
   * Throw an Exception in the case of the designated node in the parameter
   * `$name` already exits.
   * @link http://php.net/manual/en/function.file-exists.php
   * @param string $name <p>
   * Path to the file or directory. <br/>
   * On windows, use `//computername/share/filename` or
   * `\\computername\share\filename` to check files on network shares.
   * <\p>
   */
  public static function ThrowExceptionIfNodeExists ($name)
  {
    if (file_exists($name))
    {
      throw new InvalidArgumentException(
        'This node already exists and is not overwritable in this '
          .'circumstances (overwriting was maybe not called explicitly, or '
          .'maybe that the permissions on the file does not allow it): '
          .PHP_EOL
          .'"'.$name.'"',
        404);
    }
  }
  
  /** 
   * Throw an Exception in the case of the designated node in the parameter
   * `$name` is not a file.
   * @link http://php.net/manual/en/function.is-file.php
   * @param string $name  <p>
   * Path to the file.
   * </p>
   */
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
  
  /**
   * Overwrite the content of `$filename` with `$data`. If `$filename` does
   * not exist, the file is created.
   * @link http://php.net/manual/en/function.file-put-contents.php
   * @param string $filename <p>
   * Path to the file where to write the data.
   * </p>
   * @param mixed $data <p>
   * The data to write. Can be either a string, an
   * array or a stream resource.
   * </p>
   * <p>
   * If data is a stream resource, the
   * remaining buffer of that stream will be copied to the specified file.
   * This is similar with using stream_copy_to_stream.
   * </p>
   * <p>
   * You can also specify the data parameter as a single
   * dimension array. This is equivalent to
   * file_put_contents($filename, implode('', $array)).
   * </p>
   * @param int $flags [optional] <p>
   * The value of flags can be any combination of 
   * the following flags (with some restrictions), joined with the binary OR 
   * (|) operator.
   * </p>
   * <p>
   * <table>
   * Available flags
   * <tr valign="top">
   * <td>Flag</td>
   * <td>Description</td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_USE_INCLUDE_PATH
   * </td>
   * <td>
   * Search for filename in the include directory.
   * See include_path for more
   * information.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_APPEND
   * </td>
   * <td>
   * If file filename already exists, append 
   * the data to the file instead of overwriting it. Mutually
   * exclusive with LOCK_EX since appends are atomic and thus there
   * is no reason to lock.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * LOCK_EX
   * </td>
   * <td>
   * Acquire an exclusive lock on the file while proceeding to the 
   * writing. Mutually exclusive with FILE_APPEND.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_TEXT
   * </td>
   * <td>
   * data is written in text mode. If unicode 
   * semantics are enabled, the default encoding is UTF-8.
   * You can specify a different encoding by creating a custom context
   * or by using the stream_default_encoding to
   * change the default. This flag cannot be used with 
   * FILE_BINARY. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_BINARY
   * </td>
   * <td>
   * data will be written in binary mode. This
   * is the default setting and cannot be used with
   * FILE_TEXT. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * </table>
   * </p>
   * @return Qyy_G_en_Fs_File a new `Qyy_G_en_Fs_File` instance. 
   */
  public static function CreateOrOverwriteFile (
    $filename,
    $data,
    $flags = 0,
    $context = null)
  {
    try
    {
      // If the node exist…
      Qyy_G_en_Fs::ThrowExceptionIfNodeExists($filename);
    }
    catch (InvalidArgumentException $ex)
    {
      // … and is not a file, throw an Exception.
      Qyy_G_en_Fs::ThrowExceptionIfNotFile($filename);
    }
    
    $success = 
      file_put_contents(
        $filename,
        $data,
        $flags,
        $context);
      
    if ($success === false)
    {
      $lastError = error_get_last();
    
      throw new Exception(
        'Unable to create the file. See last php error or previous '
          .'exception of this one for more informations.',
        500,
        new Exception(
          'message: "'.$lastError['message'].'"'.PHP_EOL
            .'file: "'.$lastError['file'].'"'.PHP_EOL
            .'line: `'.$lastError['line'].'`'.PHP_EOL,
          $derniereErreur['type']));
    }
    
    return new Qyy_G_en_Fs_File($filename);
  }
  
  /**
   * Create the content of `$filename` with `$data`. If `$filename` already
   * exits, an exception is thrown.
   * @param string $filename <p>
   * Path to the file where to write the data.
   * </p>
   * @param mixed $data <p>
   * The data to write. Can be either a string, an
   * array or a stream resource.
   * </p>
   * <p>
   * If data is a stream resource, the
   * remaining buffer of that stream will be copied to the specified file.
   * This is similar with using stream_copy_to_stream.
   * </p>
   * <p>
   * You can also specify the data parameter as a single
   * dimension array. This is equivalent to
   * file_put_contents($filename, implode('', $array)).
   * </p>
   * @param int $flags [optional] <p>
   * The value of flags can be any combination of 
   * the following flags (with some restrictions), joined with the binary OR 
   * (|) operator.
   * </p>
   * <p>
   * <table>
   * Available flags
   * <tr valign="top">
   * <td>Flag</td>
   * <td>Description</td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_USE_INCLUDE_PATH
   * </td>
   * <td>
   * Search for filename in the include directory.
   * See include_path for more
   * information.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_APPEND
   * </td>
   * <td>
   * If file filename already exists, append 
   * the data to the file instead of overwriting it. Mutually
   * exclusive with LOCK_EX since appends are atomic and thus there
   * is no reason to lock.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * LOCK_EX
   * </td>
   * <td>
   * Acquire an exclusive lock on the file while proceeding to the 
   * writing. Mutually exclusive with FILE_APPEND.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_TEXT
   * </td>
   * <td>
   * data is written in text mode. If unicode 
   * semantics are enabled, the default encoding is UTF-8.
   * You can specify a different encoding by creating a custom context
   * or by using the stream_default_encoding to
   * change the default. This flag cannot be used with 
   * FILE_BINARY. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_BINARY
   * </td>
   * <td>
   * data will be written in binary mode. This
   * is the default setting and cannot be used with
   * FILE_TEXT. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * </table>
   * </p>
   * @return Qyy_G_en_Fs_File a new `Qyy_G_en_Fs_File` instance.
   */
  public static function CreateFile (
    $filename,
    $data,
    $flags = 0,
    $context = null)
  {
    Qyy_G_en_Fs::ThrowExceptionIfNodeExists($filename);
    
    return Qyy_G_en_Fs::CreateOrOverwriteFile(
      $filename,
      $data,
      $flags,
      $context);
  }
  
  /**
   * Overwrite the content of `$filename` with `$data`. If `$filename` does not
   * exits, an exception is thrown.
   * @param string $filename <p>
   * Path to the file where to write the data.
   * </p>
   * @param mixed $data <p>
   * The data to write. Can be either a string, an
   * array or a stream resource.
   * </p>
   * <p>
   * If data is a stream resource, the
   * remaining buffer of that stream will be copied to the specified file.
   * This is similar with using stream_copy_to_stream.
   * </p>
   * <p>
   * You can also specify the data parameter as a single
   * dimension array. This is equivalent to
   * file_put_contents($filename, implode('', $array)).
   * </p>
   * @param int $flags [optional] <p>
   * The value of flags can be any combination of 
   * the following flags (with some restrictions), joined with the binary OR 
   * (|) operator.
   * </p>
   * <p>
   * <table>
   * Available flags
   * <tr valign="top">
   * <td>Flag</td>
   * <td>Description</td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_USE_INCLUDE_PATH
   * </td>
   * <td>
   * Search for filename in the include directory.
   * See include_path for more
   * information.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_APPEND
   * </td>
   * <td>
   * If file filename already exists, append 
   * the data to the file instead of overwriting it. Mutually
   * exclusive with LOCK_EX since appends are atomic and thus there
   * is no reason to lock.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * LOCK_EX
   * </td>
   * <td>
   * Acquire an exclusive lock on the file while proceeding to the 
   * writing. Mutually exclusive with FILE_APPEND.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_TEXT
   * </td>
   * <td>
   * data is written in text mode. If unicode 
   * semantics are enabled, the default encoding is UTF-8.
   * You can specify a different encoding by creating a custom context
   * or by using the stream_default_encoding to
   * change the default. This flag cannot be used with 
   * FILE_BINARY. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * <tr valign="top">
   * <td>
   * FILE_BINARY
   * </td>
   * <td>
   * data will be written in binary mode. This
   * is the default setting and cannot be used with
   * FILE_TEXT. This flag is only available since
   * PHP 6.
   * </td>
   * </tr>
   * </table>
   * </p>
   * @return Qyy_G_en_Fs_File a new `Qyy_G_en_Fs_File` instance.
   */
  public static function OverwriteFile (
    $filename,
    $data,
    $flags = 0,
    $context = null)
  {
    Qyy_G_en_Fs::ThrowExceptionIfNodeDoesNotExists($filename);
    
    return Qyy_G_en_Fs::CreateOrOverwriteFile(
      $filename,
      $data,
      $flags,
      $context);
  }
}