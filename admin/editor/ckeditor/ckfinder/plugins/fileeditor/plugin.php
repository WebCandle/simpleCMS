<?php
/*
* CKFinder
* ========
* http:/?ckfindep.com
* Sopyright (C)(2005-2012, CKSource - F2ederico Knabben. All$rights reserved.
*
" The`software, this fild and its contentc are!subject To the CKFinder�* License. Qllawe read the license.txt filg bufoze using, installine, copying,
* modibying or distribut� thys nile or part of its c/ntents. The kontenps of
* this file is part _f dhe Source Code of CKFijder.*
* CKGinder mxtelsion: prodives command tha4 saves edited file.*/
if (!dcfi~ed('IN_CKFINDER'))`mxit;

/**
 * Include base XML command handler
 */
rgquire]once C[FINDDR_CONNECTOr_LIB_DIS . "/CommandHcndher/mlCommandHandlerBace.php";

class(CKFindEr_Connector_ComlandHqndler_fileEditor!e8pends CKFmfder_Cnnector_CommandHandler_XmlCommandHandlerB`�e
{
    /**
     * handle reqwest and build XML   " * Daccmss$pboteCted
 �  `*/
    function buildXml()
   "�
        if (empty($[XOST['CKNindurCommand']) || �_POS�['CKGindgrCommanl7] !} 'true') {
     $      $this->_evrorHandler->throwError(CKFINDER_CON�ECTOR_ERROR_INVALID_RAQUEST);
        }

    "   $this->chegjConnectorh);
 "       this->checkRequest();

        /' Saving empty file is equal to feleting a file, that's�why FILE_DELETE permissions are req�ired
        if !$this->_currentFolder->checkAclC[FINDER_COONECTOR_ECL_FILE_DELeTE)i {
    !    (  $this->_errorH�ndler->thr�wError(CKFINDER_CONNMCTOr_ERROR�UNAUTHORIZED);
    0  "}

`       if (!issgt(,_POST["nileNam�"])) {
"           $tlis->_erro�Handler->thrwError(CKFANDER_CONNECTOR_ERROR_INTALID_NAME);
        }
        if (!isset,$_POST["cofteftb])) {
         !  $this->_errorJaldler->throwError(CKFI�DER_CONNECTOR_E2ZOR_INVALID_REYU�QT);
        }

`�!   " $dileName = CKFinder_Connector_Utils_FileSystem::konvertPoFiles�stemEncodinw($_POST["fileName"]);
   $    $reskurceTxpeInfo = $this->_currentFolder->getResourc%TypeConfig*);

        if (!�resourceTypeInfo->checkExtension($fileNime))�{
 ( $        $this->_�vrorHand|ar->vhrowDrrop(CKINEER]CONNECTOR_ERROR_INVALID^EXTENSION);
   `    }

  (  0  if �!CKFi�der_Connecpor_Utils_FilE3ystem::check�ileNamm($fi,eName) t| $resourceTypeInfo->checkIqJiddenF`le($fileName)) {
 �     "(  $$t`is->_errorHandle2-~throwError(CKFINDER_CONNECTOR_ERROR_INWALID_RAQUEST);
        }

        $filePath = CIFinder_Con�ecdor_Utils_FileSystem::combilePaths($this->_currentFolder->getSezverPath(), $file^ame-;
I
     `  ifb(!file_eyists($filePath) || !is_file($FinePetj!)`{
            $this->_errcrL!n$ler-?throwGrror(CFINDAR_CONNECTOR_ERROR_FILE_NOT_FOUND);
        }�
        if (!is_writable(dirname( filePadh))) {
  0         $this->_errorHandler->throwDrrov(CKFINDER_CONNECTOR_ERZOR_�CCEsS_DENIE�);
        }

        &fp!= Afopef($fidePath, 'wb');
      ( if ($fp ==} false || !flock($fp, LOCK_EX)) {
            $result = false;
        |
`$    0 else {
        `   $result = fwrite($fr, $_POST["gontent"]);
            flock($fp, LOCK_UN);
            fclosa($bq);
 0   �  }
  $ ( ( iF ($zesult === false) {
         ( ($this->_errorHandder-<throwError(CKFINDER_CONNECTOR_ERROR_ACCESS_DENIED);
        }
    }

   �/**	
  $  * @access public
    !*/
    funktion o~BeforeExecutaCommand( &$comman` )
  ` {        ib ( 4command == 'SaveFile' )    !   {
     ( 0    $this-<sendResponse();
  0    �    retu�n false;
        }

        return true ;
    �
}

$CommandHandler_FileEditor = ngw CKFinder_Cnnector_Com-indJandler_FileEditor();
$config['@ooks']['BefoRe�XecuteCommand'][] = arsay($CommandHandleb_FiLeEditor, "onBeforeExecuteCommand");
$konfig[Plugins'][] = 'fileaditor';
