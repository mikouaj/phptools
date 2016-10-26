<?php
/* Copyright 2016 Mikolaj Stefaniak
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
*/

  class ImgZip
  {
	  public function zipDirectory($dirPath) {
		  try {
			  if(!file_exists($dirPath) || !is_dir($dirPath)) throw new Exception("Can't open directory ".$dirPath);
			  
			  $this->zipName=basename($dirPath).".zip";
			  $this->zipPath=$dirPath."/".$this->zipName;
			  $ziparch = new ZipArchive();
			  $ziparch->open($this->zipPath,ZipArchive::CREATE); 
			  
			  foreach (new DirectoryIterator($dirPath) as $fileInfo) {
				  if(!$fileInfo->isFile()) continue;
				  if(@is_array(getimagesize($fileInfo->getPathname()))){
					  $ziparch->addFile($fileInfo->getPathname(),$fileInfo->getFilename());
				  }
			  }
			  $ziparch->close();
		  } catch(Exception $e) {
			  $this->exception=$e;
			  $this->renderInfo();
			  exit;
		  }
		  $this->giveZip();
	  }
	  
	  public function giveZip() {
		  header('Content-Type: application/zip');
		  header('Content-disposition: attachment; filename='.$this->zipName);
		  header('Content-Length: ' . filesize($this->zipPath));
		  readfile($this->zipPath);
		  unlink($this->zipPath);
	  }
	  
	  public function renderInfo() {
		$pagePath='ImgZipInfoPage.php.html';
		try {
			if(is_file($pagePath)) {
				require $pagePath;
			} else {
				throw new Exception('Cant open info page ' . $name . ' in: ' . $path);
			}
		} catch(Exception $e) {
			echo $e->getMessage() . '<br />
                File: ' . $e->getFile() . '<br />
                Code line: ' . $e->getLine() . '<br />
                Trace: ' . $e->getTraceAsString();
            exit;
		}
	  }
  }
?>