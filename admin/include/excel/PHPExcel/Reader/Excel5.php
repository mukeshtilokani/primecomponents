<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2013 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel_Reader_Excel5
 * @copyright  Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

// Original file header of ParseXL (used as the base for this class):
// --------------------------------------------------------------------------------
// Adapted from Excel_Spreadsheet_Reader developed by users bizon153,
// trex005, and mmp11 (SourceForge.net)
// http://sourceforge.net/projects/phpexcelreader/
// Primary changes made by canyoncasa (dvc) for ParseXL 1.00 ...
//	 Modelled moreso after Perl Excel Parse/Write modules
//	 Added Parse_Excel_Spreadsheet object
//		 Reads a whole worksheet or tab as row,column array or as
//		 associated hash of indexed rows and named column fields
//	 Added variables for worksheet (tab) indexes and names
//	 Added an object call for loading individual woorksheets
//	 Changed default indexing defaults to 0 based arrays
//	 Fixed date/time and percent formats
//	 Includes patches found at SourceForge...
//		 unicode patch by nobody
//		 unpack("d") machine depedency patch by matchy
//		 boundsheet utf16 patch by bjaenichen
//	 Renamed functions for shorter names
//	 General code cleanup and rigor, including <80 column width
//	 Included a testcase Excel file and PHP example calls
//	 Code works for PHP 5.x

// Primary changes made by canyoncasa (dvc) for ParseXL 1.10 ...
// http://sourceforge.net/tracker/index.php?func=detail&aid=1466964&group_id=99160&atid=623334
//	 Decoding of formula conditions, results, and tokens.
//	 Support for user-defined named cells added as an array "namedcells"
//		 Patch code for user-defined named cells supports single cells only.
//		 NOTE: this patch only works for BIFF8 as BIFF5-7 use a different
//		 external sheet reference structure


/** PHPExcel root directory */
if (!defined('PHPEXCEL_ROOT')) {
	/**
	 * @ignore
	 */
	define('PHPEXCEL_ROOT', dirname(__FILE__) . '/../../');
	require(PHPEXCEL_ROOT . 'PHPExcel/Autoloader.php');
}

/**
 * PHPExcel_Reader_Excel5
 *
 * This class uses {@link http://sourceforge.net/projects/phpexcelreader/parseXL}
 *
 * @category	PHPExcel
 * @package		PHPExcel_Reader_Excel5
 * @copyright	Copyright (c) 2006 - 2013 PHPExcel (http://www.codeplex.com/PHPExcel)
 */
class PHPExcel_Reader_Excel5 extends PHPExcel_Reader_Abstract implements PHPExcel_Reader_IReader
{
	// ParseXL definitions
	const XLS_BIFF8						= 0x0600;
	const XLS_BIFF7						= 0x0500;
	const XLS_WorkbookGlobals			= 0x0005;
	const XLS_Worksheet					= 0x0010;

	// record identifiers
	const XLS_Type_FORMULA				= 0x0006;
	const XLS_Type_EOF					= 0x000a;
	const XLS_Type_PROTECT				= 0x0012;
	const XLS_Type_OBJECTPROTECT		= 0x0063;
	const XLS_Type_SCENPROTECT			= 0x00dd;
	const XLS_Type_PASSWORD				= 0x0013;
	const XLS_Type_HEADER				= 0x0014;
	const XLS_Type_FOOTER				= 0x0015;
	const XLS_Type_EXTERNSHEET			= 0x0017;
	const XLS_Type_DEFINEDNAME			= 0x0018;
	const XLS_Type_VERTICALPAGEBREAKS	= 0x001a;
	const XLS_Type_HORIZONTALPAGEBREAKS	= 0x001b;
	const XLS_Type_NOTE					= 0x001c;
	const XLS_Type_SELECTION			= 0x001d;
	const XLS_Type_DATEMODE				= 0x0022;
	const XLS_Type_EXTERNNAME			= 0x0023;
	const XLS_Type_LEFTMARGIN			= 0x0026;
	const XLS_Type_RIGHTMARGIN			= 0x0027;
	const XLS_Type_TOPMARGIN			= 0x0028;
	const XLS_Type_BOTTOMMARGIN			= 0x0029;
	const XLS_Type_PRINTGRIDLINES		= 0x002b;
	const XLS_Type_FILEPASS				= 0x002f;
	const XLS_Type_FONT					= 0x0031;
	const XLS_Type_CONTINUE				= 0x003c;
	const XLS_Type_PANE					= 0x0041;
	const XLS_Type_CODEPAGE				= 0x0042;
	const XLS_Type_DEFCOLWIDTH 			= 0x0055;
	const XLS_Type_OBJ					= 0x005d;
	const XLS_Type_COLINFO				= 0x007d;
	const XLS_Type_IMDATA				= 0x007f;
	const XLS_Type_SHEETPR				= 0x0081;
	const XLS_Type_HCENTER				= 0x0083;
	const XLS_Type_VCENTER				= 0x0084;
	const XLS_Type_SHEET				= 0x0085;
	const XLS_Type_PALETTE				= 0x0092;
	const XLS_Type_SCL					= 0x00a0;
	const XLS_Type_PAGESETUP			= 0x00a1;
	const XLS_Type_MULRK				= 0x00bd;
	const XLS_Type_MULBLANK				= 0x00be;
	const XLS_Type_DBCELL				= 0x00d7;
	const XLS_Type_XF					= 0x00e0;
	const XLS_Type_MERGEDCELLS			= 0x00e5;
	const XLS_Type_MSODRAWINGGROUP		= 0x00eb;
	const XLS_Type_MSODRAWING			= 0x00ec;
	const XLS_Type_SST					= 0x00fc;
	const XLS_Type_LABELSST				= 0x00fd;
	const XLS_Type_EXTSST				= 0x00ff;
	const XLS_Type_EXTERNALBOOK			= 0x01ae;
	const XLS_Type_DATAVALIDATIONS		= 0x01b2;
	const XLS_Type_TXO					= 0x01b6;
	const XLS_Type_HYPERLINK			= 0x01b8;
	const XLS_Type_DATAVALIDATION		= 0x01be;
	const XLS_Type_DIMENSION			= 0x0200;
	const XLS_Type_BLANK				= 0x0201;
	const XLS_Type_NUMBER				= 0x0203;
	const XLS_Type_LABEL				= 0x0204;
	const XLS_Type_BOOLERR				= 0x0205;
	const XLS_Type_STRING				= 0x0207;
	const XLS_Type_ROW					= 0x0208;
	const XLS_Type_INDEX				= 0x020b;
	const XLS_Type_ARRAY				= 0x0221;
	const XLS_Type_DEFAULTROWHEIGHT 	= 0x0225;
	const XLS_Type_WINDOW2				= 0x023e;
	const XLS_Type_RK					= 0x027e;
	const XLS_Type_STYLE				= 0x0293;
	const XLS_Type_FORMAT				= 0x041e;
	const XLS_Type_SHAREDFMLA			= 0x04bc;
	const XLS_Type_BOF					= 0x0809;
	const XLS_Type_SHEETPROTECTION		= 0x0867;
	const XLS_Type_RANGEPROTECTION		= 0x0868;
	const XLS_Type_SHEETLAYOUT			= 0x0862;
	const XLS_Type_XFEXT				= 0x087d;
	const XLS_Type_PAGELAYOUTVIEW		= 0x088b;
	const XLS_Type_UNKNOWN				= 0xffff;


	/**
	 * Summary Information stream data.
	 *
	 * @var string
	 */
	private $_summaryInformation;

	/**
	 * Extended Summary Information stream data.
	 *
	 * @var string
	 */
	private $_documentSummaryInformation;

	/**
	 * User-Defined Properties stream data.
	 *
	 * @var string
	 */
	private $_userDefinedProperties;

	/**
	 * Workbook stream data. (Includes workbook globals substream as well as sheet substreams)
	 *
	 * @var string
	 */
	private $_data;

	/**
	 * Size in bytes of $this->_data
	 *
	 * @var int
	 */
	private $_dataSize;

	/**
	 * Current position in stream
	 *
	 * @var integer
	 */
	private $_pos;

	/**
	 * Workbook to be returned by the reader.
	 *
	 * @var PHPExcel
	 */
	private $_phpExcel;

	/**
	 * Worksheet that is currently being built by the reader.
	 *
	 * @var PHPExcel_Worksheet
	 */
	private $_phpSheet;

	/**
	 * BIFF version
	 *
	 * @var int
	 */
	private $_version;

	/**
	 * Codepage set in the Excel file being read. Only important for BIFF5 (Excel 5.0 - Excel 95)
	 * For BIFF8 (Excel 97 - Excel 2003) this will always have the value 'UTF-16LE'
	 *
	 * @var string
	 */
	private $_codepage;

	/**
	 * Shared formats
	 *
	 * @var array
	 */
	private $_formats;

	/**
	 * Shared fonts
	 *
	 * @var array
	 */
	private $_objFonts;

	/**
	 * Color palette
	 *
	 * @var array
	 */
	private $_palette;

	/**
	 * Worksheets
	 *
	 * @var array
	 */
	private $_sheets;

	/**
	 * External books
	 *
	 * @var array
	 */
	private $_externalBooks;

	/**
	 * REF structures. Only applies to BIFF8.
	 *
	 * @var array
	 */
	private $_ref;

	/**
	 * External names
	 *
	 * @var array
	 */
	private $_externalNames;

	/**
	 * Defined names
	 *
	 * @var array
	 */
	private $_definedname;

	/**
	 * Shared strings. Only applies to BIFF8.
	 *
	 * @var array
	 */
	private $_sst;

	/**
	 * Panes are frozen? (in sheet currently being read). See WINDOW2 record.
	 *
	 * @var boolean
	 */
	private $_frozen;

	/**
	 * Fit printout to number of pages? (in sheet currently being read). See SHEETPR record.
	 *
	 * @var boolean
	 */
	private $_isFitToPages;

	/**
	 * Objects. One OBJ record contributes with one entry.
	 *
	 * @var array
	 */
	private $_objs;

	/**
	 * Text Objects. One TXO record corresponds with one entry.
	 *
	 * @var array
	 */
	private $_textObjects;

	/**
	 * Cell Annotations (BIFF8)
	 *
	 * @var array
	 */
	private $_cellNotes;

	/**
	 * The combined MSODRAWINGGROUP data
	 *
	 * @var string
	 */
	private $_drawingGroupData;

	/**
	 * The combined MSODRAWING data (per sheet)
	 *
	 * @var string
	 */
	private $_drawingData;

	/**
	 * Keep track of XF index
	 *
	 * @var int
	 */
	private $_xfIndex;

	/**
	 * Mapping of XF index (that is a cell XF) to final index in cellXf collection
	 *
	 * @var array
	 */
	private $_mapCellXfIndex;

	/**
	 * Mapping of XF index (that is a style XF) to final index in cellStyleXf collection
	 *
	 * @var array
	 */
	private $_mapCellStyleXfIndex;

	/**
	 * The shared formulas in a sheet. One SHAREDFMLA record contributes with one value.
	 *
	 * @var array
	 */
	private $_sharedFormulas;

	/**
	 * The shared formula parts in a sheet. One FORMULA record contributes with one value if it
	 * refers to a shared formula.
	 *
	 * @var array
	 */
	private $_sharedFormulaParts;


	/**
	 * Create a new PHPExcel_Reader_Excel5 instance
	 */
	public function __construct() {
		$this->_readFilter = new PHPExcel_Reader_DefaultReadFilter();
	}


	/**
	 * Can the current PHPExcel_Reader_IReader read the file?
	 *
	 * @param 	string 		$pFilename
	 * @return 	boolean
	 * @throws PHPExcel_Reader_Exception
	 */
	public function canRead($pFilename)
	{
		// Check if file exists
		if (!file_exists($pFilename)) {
			throw new PHPExcel_Reader_Exception("Could not open " . $pFilename . " for reading! File does not exist.");
		}

		try {
			// Use ParseXL for the hard work.
			$ole = new PHPExcel_Shared_OLERead();

			// get excel data
			$res = $ole->read($pFilename);
			return true;
		} catch (PHPExcel_Exception $e) {
			return false;
		}
	}


	/**
	 * Reads names of the worksheets from a file, without parsing the whole file to a PHPExcel object
	 *
	 * @param 	string 		$pFilename
	 * @throws 	PHPExcel_Reader_Exception
	 */
	public function listWorksheetNames($pFilename)
	{
		// Check if file exists
		if (!file_exists($pFilename)) {
			throw new PHPExcel_Reader_Exception("Could not open " . $pFilename . " for reading! File does not exist.");
		}

		$worksheetNames = array();

		// Read the OLE file
		$this->_loadOLE($pFilename);

		// total byte size of Excel data (workbook global substream + sheet substreams)
		$this->_dataSize = strlen($this->_data);

		$this->_pos		= 0;
		$this->_sheets	= array();

		// Parse Workbook Global Substream
		while ($this->_pos < $this->_dataSize) {
			$code = self::_GetInt2d($this->_data, $this->_pos);

			switch ($code) {
				case self::XLS_Type_BOF:	$this->_readBof();		break;
				case self::XLS_Type_SHEET:	$this->_readSheet();	break;
				case self::XLS_Type_EOF:	$this->_readDefault();	break 2;
				default:					$this->_readDefault();	break;
			}
		}

		foreach ($this->_sheets as $sheet) {
			if ($sheet['sheetType'] != 0x00) {
				// 0x00: Worksheet, 0x02: Chart, 0x06: Visual Basic module
				continue;
			}

			$worksheetNames[] = $sheet['name'];
		}

		return $worksheetNames;
	}


	/**
	 * Return worksheet info (Name, Last Column Letter, Last Column Index, Total Rows, Total Columns)
	 *
	 * @param   string     $pFilename
	 * @throws   PHPExcel_Reader_Exception
	 */
	public function listWorksheetInfo($pFilename)
	{
		// Check if file exists
		if (!file_exists($pFilename)) {
			throw new PHPExcel_Reader_Exception("Could not open " . $pFilename . " for reading! File does not exist.");
		}

		$worksheetInfo = array();

		// Read the OLE file
		$this->_loadOLE($pFilename);

		// total byte size of Excel data (workbook global substream + sheet substreams)
		$this->_dataSize = strlen($this->_data);

		// initialize
		$this->_pos    = 0;
		$this->_sheets = array();

		// Parse Workbook Global Substream
		while ($this->_pos < $this->_dataSize) {
			$code = self::_GetInt2d($this->_data, $this->_pos);

			switch ($code) {
				case self::XLS_Type_BOF:        $this->_readBof();        break;
				case self::XLS_Type_SHEET:      $this->_readSheet();      break;
				case self::XLS_Type_EOF:        $this->_readDefault();    break 2;
				default:                        $this->_readDefault();    break;
			}
		}

		// Parse the individual sheets
		foreach ($this->_sheets as $sheet) {

			if ($sheet['sheetType'] != 0x00) {
				// 0x00: Worksheet
				// 0x02: Chart
				// 0x06: Visual Basic module
				continue;
			}

			$tmpInfo = array();
			$tmpInfo['worksheetName'] = $sheet['name'];
			$tmpInfo['lastColumnLetter'] = 'A';
			$tmpInfo['lastColumnIndex'] = 0;
			$tmpInfo['totalRows'] = 0;
			$tmpInfo['totalColumns'] = 0;

			$this->_pos = $sheet['offset'];

			while ($this->_pos <= $this->_dataSize - 4) {
				$code = self::_GetInt2d($this->_data, $this->_pos);

				switch ($code) {
					case self::XLS_Type_RK:
					case self::XLS_Type_LABELSST:
					case self::XLS_Type_NUMBER:
					case self::XLS_Type_FORMULA:
					case self::XLS_Type_BOOLERR:
					case self::XLS_Type_LABEL:
						$length = self::_GetInt2d($this->_data, $this->_pos + 2);
						$recordData = substr($this->_data, $this->_pos + 4, $length);

						// move stream pointer to next record
						$this->_pos += 4 + $length;

						$rowIndex = self::_GetInt2d($recordData, 0) + 1;
						$columnIndex = self::_GetInt2d($recordData, 2);

						$tmpInfo['totalRows'] = max($tmpInfo['totalRows'], $rowIndex);
						$tmpInfo['lastColumnIndex'] = max($tmpInfo['lastColumnIndex'], $columnIndex);
						break;
					case self::XLS_Type_BOF:      $this->_readBof();          break;
					case self::XLS_Type_EOF:      $this->_readDefault();      break 2;
					default:                      $this->_readDefault();      break;
				}
			}

			$tmpInfo['lastColumnLetter'] = PHPExcel_Cell::stringFromColumnIndex($tmpInfo['lastColumnIndex']);
			$tmpInfo['totalColumns'] = $tmpInfo['lastColumnIndex'] + 1;

			$worksheetInfo[] = $tmpInfo;
		}

		return $worksheetInfo;
	}


	/**
	 * Loads PHPExcel from file
	 *
	 * @param 	string 		$pFilename
	 * @return 	PHPExcel
	 * @throws 	PHPExcel_Reader_Exception
	 */
	public function load($pFilename)
	{
		// Read the OLE file
		$this->_loadOLE($pFilename);

		// Initialisations
		$this->_phpExcel = new PHPExcel;
		$this->_phpExcel->removeSheetByIndex(0); // remove 1st sheet
		if (!$this->_readDataOnly) {
			$this->_phpExcel->removeCellStyleXfByIndex(0); // remove the default style
			$this->_phpExcel->removeCellXfByIndex(0); // remove the default style
		}

		// Read the summary information stream (containing meta data)
		$this->_readSummaryInformation();

		// Read the Additional document summary information stream (containing application-specific meta data)
		$this->_readDocumentSummaryInformation();

		// total byte size of Excel data (workbook global substream + sheet substreams)
		$this->_dataSize = strlen($this->_data);

		// initialize
		$this->_pos					= 0;
		$this->_codepage			= 'CP1252';
		$this->_formats				= array();
		$this->_objFonts			= array();
		$this->_palette				= array();
		$this->_sheets				= array();
		$this->_externalBooks		= array();
		$this->_ref					= array();
		$this->_definedname			= array();
		$this->_sst					= array();
		$this->_drawingGroupData	= '';
		$this->_xfIndex				= '';
		$this->_mapCellXfIndex		= array();
		$this->_mapCellStyleXfIndex	= array();

		// Parse Workbook Global Substream
		while ($this->_pos < $this->_dataSize) {
			$code = self::_GetInt2d($this->_data, $this->_pos);

			switch ($code) {
				case self::XLS_Type_BOF:			$this->_readBof();				break;
				case self::XLS_Type_FILEPASS:		$this->_readFilepass();			break;
				case self::XLS_Type_CODEPAGE:		$this->_readCodepage();			break;
				case self::XLS_Type_DATEMODE:		$this->_readDateMode();			break;
				case self::XLS_Type_FONT:			$this->_readFont();				break;
				case self::XLS_Type_FORMAT:			$this->_readFormat();			break;
				case self::XLS_Type_XF:				$this->_readXf();				break;
				case self::XLS_Type_XFEXT:			$this->_readXfExt();			break;
				case self::XLS_Type_STYLE:			$this->_readStyle();			break;
				case self::XLS_Type_PALETTE:		$this->_readPalette();			break;
				case self::XLS_Type_SHEET:			$this->_readSheet();			break;
				case self::XLS_Type_EXTERNALBOOK:	$this->_readExternalBook();		break;
				case self::XLS_Type_EXTERNNAME:		$this->_readExternName();		break;
				case self::XLS_Type_EXTERNSHEET:	$this->_readExternSheet();		break;
				case self::XLS_Type_DEFINEDNAME:	$this->_readDefinedName();		break;
				case self::XLS_Type_MSODRAWINGGROUP:	$this->_readMsoDrawingGroup();	break;
				case self::XLS_Type_SST:			$this->_readSst();				break;
				case self::XLS_Type_EOF:			$this->_readDefault();			break 2;
				default:							$this->_readDefault();			break;
			}
		}

		// Resolve indexed colors for font, fill, and border colors
		// Cannot be resolved already in XF record, because PALETTE record comes afterwards
		if (!$this->_readDataOnly) {
			foreach ($this->_objFonts as $objFont) {
				if (isset($objFont->colorIndex)) {
					$color = self::_readColor($objFont->colorIndex,$this->_palette,$this->_version);
					$objFont->getColor()->setRGB($color['rgb']);
				}
			}

			foreach ($this->_phpExcel->getCellXfCollection() as $objStyle) {
				// fill start and end color
				$fill = $objStyle->getFill();

				if (isset($fill->startcolorIndex)) {
					$startColor = self::_readColor($fill->startcolorIndex,$this->_palette,$this->_version);
					$fill->getStartColor()->setRGB($startColor['rgb']);
				}

				if (isset($fill->endcolorIndex)) {
					$endColor = self::_readColor($fill->endcolorIndex,$this->_palette,$this->_version);
					$fill->getEndColor()->setRGB($endColor['rgb']);
				}

				// border colors
				$top      = $objStyle->getBorders()->getTop();
				$right    = $objStyle->getBorders()->getRight();
				$bottom   = $objStyle->getBorders()->getBottom();
				$left     = $objStyle->getBorders()->getLeft();
				$diagonal = $objStyle->getBorders()->getDiagonal();

				if (isset($top->colorIndex)) {
					$borderTopColor = self::_readColor($top->colorIndex,$this->_palette,$this->_version);
					$top->getColor()->setRGB($borderTopColor['rgb']);
				}

				if (isset($right->colorIndex)) {
					$borderRightColor = self::_readColor($right->colorIndex,$this->_palette,$this->_version);
					$right->getColor()->setRGB($borderRightColor['rgb']);
				}

				if (isset($bottom->colorIndex)) {
					$borderBottomColor = self::_readColor($bottom->colorIndex,$this->_palette,$this->_version);
					$bottom->getColor()->setRGB($borderBottomColor['rgb']);
				}

				if (isset($left->colorIndex)) {
					$borderLeftColor = self::_readColor($left->colorIndex,$this->_palette,$this->_version);
					$left->getColor()->setRGB($borderLeftColor['rgb']);
				}

				if (isset($diagonal->colorIndex)) {
					$borderDiagonalColor = self::_readColor($diagonal->colorIndex,$this->_palette,$this->_version);
					$diagonal->getColor()->setRGB($borderDiagonalColor['rgb']);
				}
			}
		}

		// treat MSODRAWINGGROUP records, workbook-level Escher
		if (!$this->_readDataOnly && $this->_drawingGroupData) {
			$escherWorkbook = new PHPExcel_Shared_Escher();
			$reader = new PHPExcel_Reader_Excel5_Escher($escherWorkbook);
			$escherWorkbook = $reader->load($this->_drawingGroupData);

			// debug Escher stream
			//$debug = new Debug_Escher(new PHPExcel_Shared_Escher());
			//$debug->load($this->_drawingGroupData);
		}

		// Parse the individual sheets
		foreach ($this->_sheets as $sheet) {

			if ($sheet['sheetType'] != 0x00) {
				// 0x00: Worksheet, 0x02: Chart, 0x06: Visual Basic module
				continue;
			}

			// check if sheet should be skipped
			if (isset($this->_loadSheetsOnly) && !in_array($sheet['name'], $this->_loadSheetsOnly)) {
				continue;
			}

			// add sheet to PHPExcel object
			$this->_phpSheet = $this->_phpExcel->createSheet();
			//	Use false for $updateFormulaCellReferences to prevent adjustment of worksheet references in formula
			//		cells... during the load, all formulae should be correct, and we're simply bringing the worksheet
			//		name in line with the formula, not the reverse
			$this->_phpSheet->setTitle($sheet['name'],false);
			$this->_phpSheet->setSheetState($sheet['sheetState']);

			$this->_pos = $sheet['offset'];

			// Initialize isFitToPages. May change after reading SHEETPR record.
			$this->_isFitToPages = false;

			// Initialize drawingData
			$this->_drawingData = '';

			// Initialize objs
			$this->_objs = array();

			// Initialize shared formula parts
			$this->_sharedFormulaParts = array();

			// Initialize shared formulas
			$this->_sharedFormulas = array();

			// Initialize text objs
			$this->_textObjects = array();

			// Initialize cell annotations
			$this->_cellNotes = array();
			$this->textObjRef = -1;

			while ($this->_pos <= $this->_dataSize - 4) {
				$code = self::_GetInt2d($this->_data, $this->_pos);

				switch ($code) {
					case self::XLS_Type_BOF:					$this->_readBof();						break;
					case self::XLS_Type_PRINTGRIDLINES:			$this->_readPrintGridlines();			break;
					case self::XLS_Type_DEFAULTROWHEIGHT:		$this->_readDefaultRowHeight();			break;
					case self::XLS_Type_SHEETPR:				$this->_readSheetPr();					break;
					case self::XLS_Type_HORIZONTALPAGEBREAKS:	$this->_readHorizontalPageBreaks();		break;
					case self::XLS_Type_VERTICALPAGEBREAKS:		$this->_readVerticalPageBreaks();		break;
					case self::XLS_Type_HEADER:					$this->_readHeader();					break;
					case self::XLS_Type_FOOTER:					$this->_readFooter();					break;
					case self::XLS_Type_HCENTER:				$this->_readHcenter();					break;
					case self::XLS_Type_VCENTER:				$this->_readVcenter();					break;
					case self::XLS_Type_LEFTMARGIN:				$this->_readLeftMargin();				break;
					case self::XLS_Type_RIGHTMARGIN:			$this->_readRightMargin();				break;
					case self::XLS_Type_TOPMARGIN:				$this->_readTopMargin();				break;
					case self::XLS_Type_BOTTOMMARGIN:			$this->_readBottomMargin();				break;
					case self::XLS_Type_PAGESETUP:				$this->_readPageSetup();				break;
					case self::XLS_Type_PROTECT:				$this->_readProtect();					break;
					case self::XLS_Type_SCENPROTECT:			$this->_readScenProtect();				break;
					case self::XLS_Type_OBJECTPROTECT:			$this->_readObjectProtect();			break;
					case self::XLS_Type_PASSWORD:				$this->_readPassword();					break;
					case self::XLS_Type_DEFCOLWIDTH:			$this->_readDefColWidth();				break;
					case self::XLS_Type_COLINFO:				$this->_readColInfo();					break;
					case self::XLS_Type_DIMENSION:				$this->_readDefault();					break;
					case self::XLS_Type_ROW:					$this->_readRow();						break;
					case self::XLS_Type_DBCELL:					$this->_readDefault();					break;
					case self::XLS_Type_RK:						$this->_readRk();						break;
					case self::XLS_Type_LABELSST:				$this->_readLabelSst();					break;
					case self::XLS_Type_MULRK:					$this->_readMulRk();					break;
					case self::XLS_Type_NUMBER:					$this->_readNumber();					break;
					case self::XLS_Type_FORMULA:				$this->_readFormula();					break;
					case self::XLS_Type_SHAREDFMLA:				$this->_readSharedFmla();				break;
					case self::XLS_Type_BOOLERR:				$this->_readBoolErr();					break;
					case self::XLS_Type_MULBLANK:				$this->_readMulBlank();					break;
					case self::XLS_Type_LABEL:					$this->_readLabel();					break;
					case self::XLS_Type_BLANK:					$this->_readBlank();					break;
					case self::XLS_Type_MSODRAWING:				$this->_readMsoDrawing();				break;
					case self::XLS_Type_OBJ:					$this->_readObj();						break;
					case self::XLS_Type_WINDOW2:				$this->_readWindow2();					break;
					case self::XLS_Type_PAGELAYOUTVIEW:	$this->_readPageLayoutView();					break;
					case self::XLS_Type_SCL:					$this->_readScl();						break;
					case self::XLS_Type_PANE:					$this->_readPane();						break;
					case self::XLS_Type_SELECTION:				$this->_readSelection();				break;
					case self::XLS_Type_MERGEDCELLS:			$this->_readMergedCells();				break;
					case self::XLS_Type_HYPERLINK:				$this->_readHyperLink();				break;
					case self::XLS_Type_DATAVALIDATIONS:		$this->_readDataValidations();			break;
					case self::XLS_Type_DATAVALIDATION:			$this->_readDataValidation();			break;
					case self::XLS_Type_SHEETLAYOUT:			$this->_readSheetLayout();				break;
					case self::XLS_Type_SHEETPROTECTION:		$this->_readSheetProtection();			break;
					case self::XLS_Type_RANGEPROTECTION:		$this->_readRangeProtection();			break;
					case self::XLS_Type_NOTE:					$this->_readNote();						break;
					//case self::XLS_Type_IMDATA:				$this->_readImData();					break;
					case self::XLS_Type_TXO:					$this->_readTextObject();				break;
					case self::XLS_Type_CONTINUE:				$this->_readContinue();					break;
					case self::XLS_Type_EOF:					$this->_readDefault();					break 2;
					default:									$this->_readDefault();					break;
				}

			}

			// treat MSODRAWING records, sheet-level Escher
			if (!$this->_readDataOnly && $this->_drawingData) {
				$escherWorksheet = new PHPExcel_Shared_Escher();
				$reader = new PHPExcel_Reader_Excel5_Escher($escherWorksheet);
				$escherWorksheet = $reader->load($this->_drawingData);

				// debug Escher stream
				//$debug = new Debug_Escher(new PHPExcel_Shared_Escher());
				//$debug->load($this->_drawingData);

				// get all spContainers in one long array, so they can be mapped to OBJ records
				$allSpContainers = $escherWorksheet->getDgContainer()->getSpgrContainer()->getAllSpContainers();
			}

			// treat OBJ records
			foreach ($this->_objs as $n => $obj) {
//				echo '<hr /><b>Object</b> reference is ',$n,'<br />';
//				var_dump($obj);
//				echo '<br />';

				// the first shape container never has a corresponding OBJ record, hence $n + 1
				if (isset($allSpContainers[$n + 1]) && is_object($allSpContainers[$n + 1])) {
					$spContainer = $allSpContainers[$n + 1];

					// we skip all spContainers that are a part of a group shape since we cannot yet handle those
					if ($spContainer->getNestingLevel() > 1) {
						continue;
					}

					// calculate the width and height of the shape
					list($startColumn, $startRow) = PHPExcel_Cell::coordinateFromString($spContainer->getStartCoordinates());
					list($endColumn, $endRow) = PHPExcel_Cell::coordinateFromString($spContainer->getEndCoordinates());

					$startOffsetX = $spContainer->getStartOffsetX();
					$startOffsetY = $spContainer->getStartOffsetY();
					$endOffsetX = $spContainer->getEndOffsetX();
					$endOffsetY = $spContainer->getEndOffsetY();

					$width = PHPExcel_Shared_Excel5::getDistanceX($this->_phpSheet, $startColumn, $startOffsetX, $endColumn, $endOffsetX);
					$height = PHPExcel_Shared_Excel5::getDistanceY($this->_phpSheet, $startRow, $startOffsetY, $endRow, $endOffsetY);

					// calculate offsetX and offsetY of the shape
					$offsetX = $startOffsetX * PHPExcel_Shared_Excel5::sizeCol($this->_phpSheet, $startColumn) / 1024;
					$offsetY = $startOffsetY * PHPExcel_Shared_Excel5::sizeRow($this->_phpSheet, $startRow) / 256;

					switch ($obj['otObjType']) {
						case 0x19:
							// Note
//							echo 'Cell Annotation Object<br />';
//							echo 'Object ID is ',$obj['idObjID'],'<br />';
//
							if (isset($this->_cellNotes[$obj['idObjID']])) {
								$cellNote = $this->_cellNotes[$obj['idObjID']];

								if (isset($this->_textObjects[$obj['idObjID']])) {
									$textObject = $this->_textObjects[$obj['idObjID']];
									$this->_cellNotes[$obj['idObjID']]['objTextData'] = $textObject;
								}
							}
							break;

						case 0x08:
//							echo 'Picture Object<br />';
							// picture

							// get index to BSE entry (1-based)
							$BSEindex = $spContainer->getOPT(0x0104);
							$BSECollection = $escherWorkbook->getDggContainer()->getBstoreContainer()->getBSECollection();
							$BSE = $BSECollection[$BSEindex - 1];
							$blipType = $BSE->getBlipType();

							// need check because some blip types are not supported by Escher reader such as EMF
							if ($blip = $BSE->getBlip()) {
								$ih = imagecreatefromstring($blip->getData());
								$drawing = new PHPExcel_Worksheet_MemoryDrawing();
								$drawing->setImageResource($ih);

								// width, height, offsetX, offsetY
								$drawing->setResizeProportional(false);
								$drawing->setWidth($width);
								$drawing->setHeight($height);
								$drawing->setOffsetX($offsetX);
								$drawing->setOffsetY($offsetY);

								switch ($blipType) {
									case PHPExcel_Shared_Escher_DggContainer_BstoreContainer_BSE::BLIPTYPE_JPEG:
										$drawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
										$drawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_JPEG);
										break;

									case PHPExcel_Shared_Escher_DggContainer_BstoreContainer_BSE::BLIPTYPE_PNG:
										$drawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_PNG);
										$drawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_PNG);
										break;
								}

								$drawing->setWorksheet($this->_phpSheet);
								$drawing->setCoordinates($spContainer->getStartCoordinates());
							}

							break;

						default:
							// other object type
							break;

					}
				}
			}

			// treat SHAREDFMLA records
			if ($this->_version == self::XLS_BIFF8) {
				foreach ($this->_sharedFormulaParts as $cell => $baseCell) {
					list($column, $row) = PHPExcel_Cell::coordinateFromString($cell);
					if (($this->getReadFilter() !== NULL) && $this->getReadFilter()->readCell($column, $row, $this->_phpSheet->getTitle()) ) {
						$formula = $this->_getFormulaFromStructure($this->_sharedFormulas[$baseCell], $cell);
						$this->_phpSheet->getCell($cell)->setValueExplicit('=' . $formula, PHPExcel_Cell_DataType::TYPE_FORMULA);
					}
				}
			}

			if (!empty($this->_cellNotes)) {
				foreach($this->_cellNotes as $note => $noteDetails) {
					if (!isset($noteDetails['objTextData'])) {
						if (isset($this->_textObjects[$note])) {
							$textObject = $this->_textObjects[$note];
							$noteDetails['objTextData'] = $textObject;
						} else {
							$noteDetails['objTextData']['text'] = '';
						}
					}
//					echo '<b>Cell annotation ',$note,'</b><br />';
//					var_dump($noteDetails);
//					echo '<br />';
					$cellAddress = str_replace('$','',$noteDetails['cellRef']);
					$this->_phpSheet->getComment( $cellAddress )
													->setAuthor( $noteDetails['author'] )
													->setText($this->_parseRichText($noteDetails['objTextData']['text']) );
				}
			}
		}

		// add the named ranges (defined names)
		foreach ($this->_definedname as $definedName) {
			if ($definedName['isBuiltInName']) {
				switch ($definedName['name']) {

				case pack('C', 0x06):
					// print area
					//	in general, formula looks like this: Foo!$C$7:$J$66,Bar!$A$1:$IV$2
					$ranges = explode(',', $definedName['formula']); // FIXME: what if sheetname contains comma?

					$extractedRanges = array();
					foreach ($ranges as $range) {
						// $range should look like one of these
						//		Foo!$C$7:$J$66
						//		Bar!$A$1:$IV$2

						$explodes = explode('!', $range);	// FIXME: what if sheetname contains exclamation mark?
						$sheetName = trim($explodes[0], "'");

						if (count($explodes) == 2) {
							if (strpos($explodes[1], ':') === FALSE) {
								$explodes[1] = $explodes[1] . ':' . $explodes[1];
							}
							$extractedRanges[] = str_replace('$', '', $explodes[1]); // C7:J66
						}
					}
					if ($docSheet = $this->_phpExcel->getSheetByName($sheetName)) {
						$docSheet->getPageSetup()->setPrintArea(implode(',', $extractedRanges)); // C7:J66,A1:IV2
					}
					break;

				case pack('C', 0x07):
					// print titles (repeating rows)
					// Assuming BIFF8, there are 3 cases
					// 1. repeating rows
					//		formula looks like this: Sheet!$A$1:$IV$2
					//		rows 1-2 repeat
					// 2. repeating columns
					//		formula looks like this: Sheet!$A$1:$B$65536
					//		columns A-B repeat
					// 3. both repeating rows and repeating columns
					//		formula looks like this: Sheet!$A$1:$B$65536,Sheet!$A$1:$IV$2

					$ranges = explode(',', $definedName['formula']); // FIXME: what if sheetname contains comma?

					foreach ($ranges as $range) {
						// $range should look like this one of these
						//		Sheet!$A$1:$B$65536
						//		Sheet!$A$1:$IV$2

						$explodes = explode('!', $range);

						if (count($explodes) == 2) {
							if ($docSheet = $this->_phpExcel->getSheetByName($explodes[0])) {

								$extractedRange = $explodes[1];
								$extractedRange = str_replace('$', '', $extractedRange);

								$coordinateStrings = explode(':', $extractedRange);
								if (count($coordinateStrings) == 2) {
									list($firstColumn, $firstRow) = PHPExcel_Cell::coordinateFromString($coordinateStrings[0]);
									list($lastColumn, $lastRow) = PHPExcel_Cell::coordinateFromString($coordinateStrings[1]);

									if ($firstColumn == 'A' and $lastColumn == 'IV') {
										// then we have repeating rows
										$docSheet->getPageSetup()->setRowsToRepeatAtTop(array($firstRow, $lastRow));
									} elseif ($firstRow == 1 and $lastRow == 65536) {
										// then we have repeating columns
										$docSheet->getPageSetup()->setColumnsToRepeatAtLeft(array($firstColumn, $lastColumn));
									}
								}
							}
						}
					}
					break;

				}
			} else {
				// Extract range
				$explodes = explode('!', $definedName['formula']);

				if (count($explodes) == 2) {
					if (($docSheet = $this->_phpExcel->getSheetByName($explodes[0])) ||
						($docSheet = $this->_phpExcel->getSheetByName(trim($explodes[0],"'")))) {
						$extractedRange = $explodes[1];
						$extractedRange = str_replace('$', '', $extractedRange);

						$localOnly = ($definedName['scope'] == 0) ? false : true;

						$scope = ($definedName['scope'] == 0) ?
							null : $this->_phpExcel->getSheetByName($this->_sheets[$definedName['scope'] - 1]['name']);

						$this->_phpExcel->addNamedRange( new PHPExcel_NamedRange((string)$definedName['name'], $docSheet, $extractedRange, $localOnly, $scope) );
					}
				} else {
					//	Named Value
					//	TODO Provide support for named values
				}
			}
		}

		return $this->_phpExcel;
	}


	/**
	 * Use OLE reader to extract the relevant data streams from the OLE file
	 *
	 * @param string $pFilename
	 */
	private function _loadOLE($pFilename)
	{
		// OLE reader
		$ole = new PHPExcel_Shared_OLERead();

		// get excel data,
		$res = $ole->read($pFilename);
		// Get workbook data: workbook stream + sheet streams
		$this->_data = $ole->getStream($ole->wrkbook);

		// Get summary information data
		$this->_summaryInformation = $ole->getStream($ole->summaryInformation);

		// Get additional document summary information data
		$this->_documentSummaryInformation = $ole->getStream($ole->documentSummaryInformation);

		// Get user-defined property data
//		$this->_userDefinedProperties = $ole->getUserDefinedProperties();
	}


	/**
	 * Read summary information
	 */
	private function _readSummaryInformation()
	{
		if (!isset($this->_summaryInformation)) {
			return;
		}

		// offset: 0; size: 2; must be 0xFE 0xFF (UTF-16 LE byte order mark)
		// offset: 2; size: 2;
		// offset: 4; size: 2; OS version
		// offset: 6; size: 2; OS indicator
		// offset: 8; size: 16
		// offset: 24; size: 4; section count
		$secCount = self::_GetInt4d($this->_summaryInformation, 24);

		// offset: 28; size: 16; first section's class id: e0 85 9f f2 f9 4f 68 10 ab 91 08 00 2b 27 b3 d9
		// offset: 44; size: 4
		$secOffset = self::_GetInt4d($this->_summaryInformation, 44);

		// section header
		// offset: $secOffset; size: 4; section length
		$secLength = self::_GetInt4d($this->_summaryInformation, $secOffset);

		// offset: $secOffset+4; size: 4; property count
		$countProperties = self::_GetInt4d($this->_summaryInformation, $secOffset+4);

		// initialize code page (used to resolve string values)
		$codePage = 'CP1252';

		// offset: ($secOffset+8); size: var
		// loop through property decarations and properties
		for ($i = 0; $i < $countProperties; ++$i) {

			// offset: ($secOffset+8) + (8 * $i); size: 4; property ID
			$id = self::_GetInt4d($this->_summaryInformation, ($secOffset+8) + (8 * $i));

			// Use value of property id as appropriate
			// offset: ($secOffset+12) + (8 * $i); size: 4; offset from beginning of section (48)
			$offset = self::_GetInt4d($this->_summaryInformation, ($secOffset+12) + (8 * $i));

			$type = self::_GetInt4d($this->_summaryInformation, $secOffset + $offset);

			// initialize property value
			$value = null;

			// extract property value based on property type
			switch ($type) {
				case 0x02: // 2 byte signed integer
					$value = self::_GetInt2d($this->_summaryInformation, $secOffset + 4 + $offset);
					break;

				case 0x03: // 4 byte signed integer
					$value = self::_GetInt4d($this->_summaryInformation, $secOffset + 4 + $offset);
					break;

				case 0x13: // 4 byte unsigned integer
					// not needed yet, fix later if necessary
					break;

				case 0x1E: // null-terminated string prepended by dword string length
					$byteLength = self::_GetInt4d($this->_summaryInformation, $secOffset + 4 + $offset);
					$value = substr($this->_summaryInformation, $secOffset + 8 + $offset, $byteLength);
					$value = PHPExcel_Shared_String::ConvertEncoding($value, 'UTF-8', $codePage);
					$value = rtrim($value);
					break;

				case 0x40: // Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
					// PHP-time
					$value = PHPExcel_Shared_OLE::OLE2LocalDate(substr($this->_summaryInformation, $secOffset + 4 + $offset, 8));
					break;

				case 0x47: // Clipboard format
					// not needed yet, fix later if necessary
					break;
			}

			switch ($id) {
				case 0x01:	//	Code Page
					$codePage = PHPExcel_Shared_CodePage::NumberToName($value);
					break;

				case 0x02:	//	Title
					$this->_phpExcel->getProperties()->setTitle($value);
					break;

				case 0x03:	//	Subject
					$this->_phpExcel->getProperties()->setSubject($value);
					break;

				case 0x04:	//	Author (Creator)
					$this->_phpExcel->getProperties()->setCreator($value);
					break;

				case 0x05:	//	Keywords
					$this->_phpExcel->getProperties()->setKeywords($value);
					break;

				case 0x06:	//	Comments (Description)
					$this->_phpExcel->getProperties()->setDescription($value);
					break;

				case 0x07:	//	Template
					//	Not supported by PHPExcel
					break;

				case 0x08:	//	Last Saved By (LastModifiedBy)
					$this->_phpExcel->getProperties()->setLastModifiedBy($value);
					break;

				case 0x09:	//	Revision
					//	Not supported by PHPExcel
					break;

				case 0x0A:	//	Total Editing Time
					//	Not supported by PHPExcel
					break;

				case 0x0B:	//	Last Printed
					//	Not supported by PHPExcel
					break;

				case 0x0C:	//	Created Date/Time
					$this->_phpExcel->getProperties()->setCreated($value);
					break;

				case 0x0D:	//	Modified Date/Time
					$this->_phpExcel->getProperties()->setModified($value);
					break;

				case 0x0E:	//	Number of Pages
					//	Not supported by PHPExcel
					break;

				case 0x0F:	//	Number of Words
					//	Not supported by PHPExcel
					break;

				case 0x10:	//	Number of Characters
					//	Not supported by PHPExcel
					break;

				case 0x11:	//	Thumbnail
					//	Not supported by PHPExcel
					break;

				case 0x12:	//	Name of creating application
					//	Not supported by PHPExcel
					break;

				case 0x13:	//	Security
					//	Not supported by PHPExcel
					break;

			}
		}
	}


	/**
	 * Read additional document summary information
	 */
	private function _readDocumentSummaryInformation()
	{
		if (!isset($this->_documentSummaryInformation)) {
			return;
		}

		//	offset: 0;	size: 2;	must be 0xFE 0xFF (UTF-16 LE byte order mark)
		//	offset: 2;	size: 2;
		//	offset: 4;	size: 2;	OS version
		//	offset: 6;	size: 2;	OS indicator
		//	offset: 8;	size: 16
		//	offset: 24;	size: 4;	section count
		$secCount = self::_GetInt4d($this->_documentSummaryInformation, 24);
//		echo '$secCount = ',$secCount,'<br />';

		// offset: 28;	size: 16;	first section's class id: 02 d5 cd d5 9c 2e 1b 10 93 97 08 00 2b 2c f9 ae
		// offset: 44;	size: 4;	first section offset
		$secOffset = self::_GetInt4d($this->_documentSummaryInformation, 44);
//		echo '$secOffset = ',$secOffset,'<br />';

		//	section header
		//	offset: $secOffset;	size: 4;	section length
		$secLength = self::_GetInt4d($this->_documentSummaryInformation, $secOffset);
//		echo '$secLength = ',$secLength,'<br />';

		//	offset: $secOffset+4;	size: 4;	property count
		$countProperties = self::_GetInt4d($this->_documentSummaryInformation, $secOffset+4);
//		echo '$countProperties = ',$countProperties,'<br />';

		// initialize code page (used to resolve string values)
		$codePage = 'CP1252';

		//	offset: ($secOffset+8);	size: var
		//	loop through property decarations and properties
		for ($i = 0; $i < $countProperties; ++$i) {
//			echo 'Property ',$i,'<br />';
			//	offset: ($secOffset+8) + (8 * $i);	size: 4;	property ID
			$id = self::_GetInt4d($this->_documentSummaryInformation, ($secOffset+8) + (8 * $i));
//			echo 'ID is ',$id,'<br />';

			// Use value of property id as appropriate
			// offset: 60 + 8 * $i;	size: 4;	offset from beginning of section (48)
			$offset = self::_GetInt4d($this->_documentSummaryInformation, ($secOffset+12) + (8 * $i));

			$type = self::_GetInt4d($this->_documentSummaryInformation, $secOffset + $offset);
//			echo 'Type is ',$type,', ';

			// initialize property value
			$value = null;

			// extract property value based on property type
			switch ($type) {
				case 0x02:	//	2 byte signed integer
					$value = self::_GetInt2d($this->_documentSummaryInformation, $secOffset + 4 + $offset);
					break;

				case 0x03:	//	4 byte signed integer
					$value = self::_GetInt4d($this->_documentSummaryInformation, $secOffset + 4 + $offset);
					break;

				case 0x0B:  // Boolean
					$value = self::_GetInt2d($this->_documentSummaryInformation, $secOffset + 4 + $offset);
					$value = ($value == 0 ? false : true);
					break;

				case 0x13:	//	4 byte unsigned integer
					// not needed yet, fix later if necessary
					break;

				case 0x1E:	//	null-terminated string prepended by dword string length
					$byteLength = self::_GetInt4d($this->_documentSummaryInformation, $secOffset + 4 + $offset);
					$value = substr($this->_documentSummaryInformation, $secOffset + 8 + $offset, $byteLength);
					$value = PHPExcel_Shared_String::ConvertEncoding($value, 'UTF-8', $codePage);
					$value = rtrim($value);
					break;

				case 0x40:	//	Filetime (64-bit value representing the number of 100-nanosecond intervals since January 1, 1601)
					// PHP-Time
					$value = PHPExcel_Shared_OLE::OLE2LocalDate(substr($this->_documentSummaryInformation, $secOffset + 4 + $offset, 8));
					break;

				case 0x47:	//	Clipboard format
					// not needed yet, fix later if necessary
					break;
			}

			switch ($id) {
				case 0x01:	//	Code Page
					$codePage = PHPExcel_Shared_CodePage::NumberToName($value);
					break;

				case 0x02:	//	Category
					$this->_phpExcel->getProperties()->setCategory($value);
					break;

				case 0x03:	//	Presentation Target
					//	Not supported by PHPExcel
					break;

				case 0x04:	//	Bytes
					//	Not supported by PHPExcel
					break;

				case 0x05:	//	Lines
					//	Not supported by PHPExcel
					break;

				case 0x06:	//	Paragraphs
					//	Not supported by PHPExcel
					break;

				case 0x07:	//	Slides
					//	Not supported by PHPExcel
					break;

				case 0x08:	//	Notes
					//	Not supported by PHPExcel
					break;

				case 0x09:	//	Hidden Slides
					//	Not supported by PHPExcel
					break;

				case 0x0A:	//	MM Clips
					//	Not supported by PHPExcel
					break;

				case 0x0B:	//	Scale Crop
					//	Not supported by PHPExcel
					break;

				case 0x0C:	//	Heading Pairs
					//	Not supported by PHPExcel
					break;

				case 0x0D:	//	Titles of Parts
					//	Not supported by PHPExcel
					break;

				case 0x0E:	//	Manager
					$this->_phpExcel->getProperties()->setManager($value);
					break;

				case 0x0F:	//	Company
					$this->_phpExcel->getProperties()->setCompany($value);
					break;

				case 0x10:	//	Links up-to-date
					//	Not supported by PHPExcel
					break;

			}
		}
	}


	/**
	 * Reads a general type of BIFF record. Does nothing except for moving stream pointer forward to next record.
	 */
	private function _readDefault()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
//		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;
	}


	/**
	 *	The NOTE record specifies a comment associated with a particular cell. In Excel 95 (BIFF7) and earlier versions,
	 *		this record stores a note (cell note). This feature was significantly enhanced in Excel 97.
	 */
	private function _readNote()
	{
//		echo '<b>Read Cell Annotation</b><br />';
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_readDataOnly) {
			return;
		}

		$cellAddress = $this->_readBIFF8CellAddress(substr($recordData, 0, 4));
		if ($this->_version == self::XLS_BIFF8) {
			$noteObjID = self::_GetInt2d($recordData, 6);
			$noteAuthor = self::_readUnicodeStringLong(substr($recordData, 8));
			$noteAuthor = $noteAuthor['value'];
//			echo 'Note Address=',$cellAddress,'<br />';
//			echo 'Note Object ID=',$noteObjID,'<br />';
//			echo 'Note Author=',$noteAuthor,'<hr />';
//
			$this->_cellNotes[$noteObjID] = array('cellRef'		=> $cellAddress,
												  'objectID'	=> $noteObjID,
												  'author'		=> $noteAuthor
												 );
		} else {
			$extension = false;
			if ($cellAddress == '$B$65536') {
				//	If the address row is -1 and the column is 0, (which translates as $B$65536) then this is a continuation
				//		note from the previous cell annotation. We're not yet handling this, so annotations longer than the
				//		max 2048 bytes will probably throw a wobbly.
				$row = self::_GetInt2d($recordData, 0);
				$extension = true;
				$cellAddress = array_pop(array_keys($this->_phpSheet->getComments()));
			}
//			echo 'Note Address=',$cellAddress,'<br />';

			$cellAddress = str_replace('$','',$cellAddress);
			$noteLength = self::_GetInt2d($recordData, 4);
			$noteText = trim(substr($recordData, 6));
//			echo 'Note Length=',$noteLength,'<br />';
//			echo 'Note Text=',$noteText,'<br />';

			if ($extension) {
				//	Concatenate this extension with the currently set comment for the cell
				$comment = $this->_phpSheet->getComment( $cellAddress );
				$commentText = $comment->getText()->getPlainText();
				$comment->setText($this->_parseRichText($commentText.$noteText) );
			} else {
				//	Set comment for the cell
				$this->_phpSheet->getComment( $cellAddress )
//													->setAuthor( $author )
													->setText($this->_parseRichText($noteText) );
			}
		}

	}


	/**
	 *	The TEXT Object record contains the text associated with a cell annotation.
	 */
	private function _readTextObject()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_readDataOnly) {
			return;
		}

		// recordData consists of an array of subrecords looking like this:
		//	grbit: 2 bytes; Option Flags
		//	rot: 2 bytes; rotation
		//	cchText: 2 bytes; length of the text (in the first continue record)
		//	cbRuns: 2 bytes; length of the formatting (in the second continue record)
		// followed by the continuation records containing the actual text and formatting
		$grbitOpts	= self::_GetInt2d($recordData, 0);
		$rot		= self::_GetInt2d($recordData, 2);
		$cchText	= self::_GetInt2d($recordData, 10);
		$cbRuns		= self::_GetInt2d($recordData, 12);
		$text		= $this->_getSplicedRecordData();

		$this->_textObjects[$this->textObjRef] = array(
				'text'		=> substr($text["recordData"],$text["spliceOffsets"][0]+1,$cchText),
				'format'	=> substr($text["recordData"],$text["spliceOffsets"][1],$cbRuns),
				'alignment'	=> $grbitOpts,
				'rotation'	=> $rot
			 );

//		echo '<b>_readTextObject()</b><br />';
//		var_dump($this->_textObjects[$this->textObjRef]);
//		echo '<br />';
	}


	/**
	 * Read BOF
	 */
	private function _readBof()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 2; size: 2; type of the following data
		$substreamType = self::_GetInt2d($recordData, 2);

		switch ($substreamType) {
			case self::XLS_WorkbookGlobals:
				$version = self::_GetInt2d($recordData, 0);
				if (($version != self::XLS_BIFF8) && ($version != self::XLS_BIFF7)) {
					throw new PHPExcel_Reader_Exception('Cannot read this Excel file. Version is too old.');
				}
				$this->_version = $version;
				break;

			case self::XLS_Worksheet:
				// do not use this version information for anything
				// it is unreliable (OpenOffice doc, 5.8), use only version information from the global stream
				break;

			default:
				// substream, e.g. chart
				// just skip the entire substream
				do {
					$code = self::_GetInt2d($this->_data, $this->_pos);
					$this->_readDefault();
				} while ($code != self::XLS_Type_EOF && $this->_pos < $this->_dataSize);
				break;
		}
	}


	/**
	 * FILEPASS
	 *
	 * This record is part of the File Protection Block. It
	 * contains information about the read/write password of the
	 * file. All record contents following this record will be
	 * encrypted.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readFilepass()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
//		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		throw new PHPExcel_Reader_Exception('Cannot read encrypted file');
	}


	/**
	 * CODEPAGE
	 *
	 * This record stores the text encoding used to write byte
	 * strings, stored as MS Windows code page identifier.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readCodepage()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 2; code page identifier
		$codepage = self::_GetInt2d($recordData, 0);

		$this->_codepage = PHPExcel_Shared_CodePage::NumberToName($codepage);
	}


	/**
	 * DATEMODE
	 *
	 * This record specifies the base date for displaying date
	 * values. All dates are stored as count of days past this
	 * base date. In BIFF2-BIFF4 this record is part of the
	 * Calculation Settings Block. In BIFF5-BIFF8 it is
	 * stored in the Workbook Globals Substream.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readDateMode()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 2; 0 = base 1900, 1 = base 1904
		PHPExcel_Shared_Date::setExcelCalendar(PHPExcel_Shared_Date::CALENDAR_WINDOWS_1900);
		if (ord($recordData{0}) == 1) {
			PHPExcel_Shared_Date::setExcelCalendar(PHPExcel_Shared_Date::CALENDAR_MAC_1904);
		}
	}


	/**
	 * Read a FONT record
	 */
	private function _readFont()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			$objFont = new PHPExcel_Style_Font();

			// offset: 0; size: 2; height of the font (in twips = 1/20 of a point)
			$size = self::_GetInt2d($recordData, 0);
			$objFont->setSize($size / 20);

			// offset: 2; size: 2; option flags
				// bit: 0; mask 0x0001; bold (redundant in BIFF5-BIFF8)
				// bit: 1; mask 0x0002; italic
				$isItalic = (0x0002 & self::_GetInt2d($recordData, 2)) >> 1;
				if ($isItalic) $objFont->setItalic(true);

				// bit: 2; mask 0x0004; underlined (redundant in BIFF5-BIFF8)
				// bit: 3; mask 0x0008; strike
				$isStrike = (0x0008 & self::_GetInt2d($recordData, 2)) >> 3;
				if ($isStrike) $objFont->setStrikethrough(true);

			// offset: 4; size: 2; colour index
			$colorIndex = self::_GetInt2d($recordData, 4);
			$objFont->colorIndex = $colorIndex;

			// offset: 6; size: 2; font weight
			$weight = self::_GetInt2d($recordData, 6);
			switch ($weight) {
				case 0x02BC:
					$objFont->setBold(true);
					break;
			}

			// offset: 8; size: 2; escapement type
			$escapement = self::_GetInt2d($recordData, 8);
			switch ($escapement) {
				case 0x0001:
					$objFont->setSuperScript(true);
					break;
				case 0x0002:
					$objFont->setSubScript(true);
					break;
			}

			// offset: 10; size: 1; underline type
			$underlineType = ord($recordData{10});
			switch ($underlineType) {
				case 0x00:
					break; // no underline
				case 0x01:
					$objFont->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
					break;
				case 0x02:
					$objFont->setUnderline(PHPExcel_Style_Font::UNDERLINE_DOUBLE);
					break;
				case 0x21:
					$objFont->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLEACCOUNTING);
					break;
				case 0x22:
					$objFont->setUnderline(PHPExcel_Style_Font::UNDERLINE_DOUBLEACCOUNTING);
					break;
			}

			// offset: 11; size: 1; font family
			// offset: 12; size: 1; character set
			// offset: 13; size: 1; not used
			// offset: 14; size: var; font name
			if ($this->_version == self::XLS_BIFF8) {
				$string = self::_readUnicodeStringShort(substr($recordData, 14));
			} else {
				$string = $this->_readByteStringShort(substr($recordData, 14));
			}
			$objFont->setName($string['value']);

			$this->_objFonts[] = $objFont;
		}
	}


	/**
	 * FORMAT
	 *
	 * This record contains information about a number format.
	 * All FORMAT records occur together in a sequential list.
	 *
	 * In BIFF2-BIFF4 other records referencing a FORMAT record
	 * contain a zero-based index into this list. From BIFF5 on
	 * the FORMAT record contains the index itself that will be
	 * used by other records.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readFormat()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			$indexCode = self::_GetInt2d($recordData, 0);

			if ($this->_version == self::XLS_BIFF8) {
				$string = self::_readUnicodeStringLong(substr($recordData, 2));
			} else {
				// BIFF7
				$string = $this->_readByteStringShort(substr($recordData, 2));
			}

			$formatString = $string['value'];
			$this->_formats[$indexCode] = $formatString;
		}
	}


	/**
	 * XF - Extended Format
	 *
	 * This record contains formatting information for cells, rows, columns or styles.
	 * According to http://support.microsoft.com/kb/147732 there are always at least 15 cell style XF
	 * and 1 cell XF.
	 * Inspection of Excel files generated by MS Office Excel shows that XF records 0-14 are cell style XF
	 * and XF record 15 is a cell XF
	 * We only read the first cell style XF and skip the remaining cell style XF records
	 * We read all cell XF records.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readXf()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		$objStyle = new PHPExcel_Style();

		if (!$this->_readDataOnly) {
			// offset:  0; size: 2; Index to FONT record
			if (self::_GetInt2d($recordData, 0) < 4) {
				$fontIndex = self::_GetInt2d($recordData, 0);
			} else {
				// this has to do with that index 4 is omitted in all BIFF versions for some strange reason
				// check the OpenOffice documentation of the FONT record
				$fontIndex = self::_GetInt2d($recordData, 0) - 1;
			}
			$objStyle->setFont($this->_objFonts[$fontIndex]);

			// offset:  2; size: 2; Index to FORMAT record
			$numberFormatIndex = self::_GetInt2d($recordData, 2);
			if (isset($this->_formats[$numberFormatIndex])) {
				// then we have user-defined format code
				$numberformat = array('code' => $this->_formats[$numberFormatIndex]);
			} elseif (($code = PHPExcel_Style_NumberFormat::builtInFormatCode($numberFormatIndex)) !== '') {
				// then we have built-in format code
				$numberformat = array('code' => $code);
			} else {
				// we set the general format code
				$numberformat = array('code' => 'General');
			}
			$objStyle->getNumberFormat()->setFormatCode($numberformat['code']);

			// offset:  4; size: 2; XF type, cell protection, and parent style XF
			// bit 2-0; mask 0x0007; XF_TYPE_PROT
			$xfTypeProt = self::_GetInt2d($recordData, 4);
			// bit 0; mask 0x01; 1 = cell is locked
			$isLocked = (0x01 & $xfTypeProt) >> 0;
			$objStyle->getProtection()->setLocked($isLocked ?
				PHPExcel_Style_Protection::PROTECTION_INHERIT : PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

			// bit 1; mask 0x02; 1 = Formula is hidden
			$isHidden = (0x02 & $xfTypeProt) >> 1;
			$objStyle->getProtection()->setHidden($isHidden ?
				PHPExcel_Style_Protection::PROTECTION_PROTECTED : PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

			// bit 2; mask 0x04; 0 = Cell XF, 1 = Cell Style XF
			$isCellStyleXf = (0x04 & $xfTypeProt) >> 2;

			// offset:  6; size: 1; Alignment and text break
			// bit 2-0, mask 0x07; horizontal alignment
			$horAlign = (0x07 & ord($recordData{6})) >> 0;
			switch ($horAlign) {
				case 0:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_GENERAL);
					break;
				case 1:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
					break;
				case 2:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					break;
				case 3:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					break;
				case 5:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
					break;
				case 6:
					$objStyle->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER_CONTINUOUS);
					break;
			}
			// bit 3, mask 0x08; wrap text
			$wrapText = (0x08 & ord($recordData{6})) >> 3;
			switch ($wrapText) {
				case 0:
					$objStyle->getAlignment()->setWrapText(false);
					break;
				case 1:
					$objStyle->getAlignment()->setWrapText(true);
					break;
			}
			// bit 6-4, mask 0x70; vertical alignment
			$vertAlign = (0x70 & ord($recordData{6})) >> 4;
			switch ($vertAlign) {
				case 0:
					$objStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
					break;
				case 1:
					$objStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					break;
				case 2:
					$objStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
					break;
				case 3:
					$objStyle->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_JUSTIFY);
					break;
			}

			if ($this->_version == self::XLS_BIFF8) {
				// offset:  7; size: 1; XF_ROTATION: Text rotation angle
					$angle = ord($recordData{7});
					$rotation = 0;
					if ($angle <= 90) {
						$rotation = $angle;
					} else if ($angle <= 180) {
						$rotation = 90 - $angle;
					} else if ($angle == 255) {
						$rotation = -165;
					}
					$objStyle->getAlignment()->setTextRotation($rotation);

				// offset:  8; size: 1; Indentation, shrink to cell size, and text direction
					// bit: 3-0; mask: 0x0F; indent level
					$indent = (0x0F & ord($recordData{8})) >> 0;
					$objStyle->getAlignment()->setIndent($indent);

					// bit: 4; mask: 0x10; 1 = shrink content to fit into cell
					$shrinkToFit = (0x10 & ord($recordData{8})) >> 4;
					switch ($shrinkToFit) {
						case 0:
							$objStyle->getAlignment()->setShrinkToFit(false);
							break;
						case 1:
							$objStyle->getAlignment()->setShrinkToFit(true);
							break;
					}

				// offset:  9; size: 1; Flags used for attribute groups

				// offset: 10; size: 4; Cell border lines and background area
					// bit: 3-0; mask: 0x0000000F; left style
					if ($bordersLeftStyle = self::_mapBorderStyle((0x0000000F & self::_GetInt4d($recordData, 10)) >> 0)) {
						$objStyle->getBorders()->getLeft()->setBorderStyle($bordersLeftStyle);
					}
					// bit: 7-4; mask: 0x000000F0; right style
					if ($bordersRightStyle = self::_mapBorderStyle((0x000000F0 & self::_GetInt4d($recordData, 10)) >> 4)) {
						$objStyle->getBorders()->getRight()->setBorderStyle($bordersRightStyle);
					}
					// bit: 11-8; mask: 0x00000F00; top style
					if ($bordersTopStyle = self::_mapBorderStyle((0x00000F00 & self::_GetInt4d($recordData, 10)) >> 8)) {
						$objStyle->getBorders()->getTop()->setBorderStyle($bordersTopStyle);
					}
					// bit: 15-12; mask: 0x0000F000; bottom style
					if ($bordersBottomStyle = self::_mapBorderStyle((0x0000F000 & self::_GetInt4d($recordData, 10)) >> 12)) {
						$objStyle->getBorders()->getBottom()->setBorderStyle($bordersBottomStyle);
					}
					// bit: 22-16; mask: 0x007F0000; left color
					$objStyle->getBorders()->getLeft()->colorIndex = (0x007F0000 & self::_GetInt4d($recordData, 10)) >> 16;

					// bit: 29-23; mask: 0x3F800000; right color
					$objStyle->getBorders()->getRight()->colorIndex = (0x3F800000 & self::_GetInt4d($recordData, 10)) >> 23;

					// bit: 30; mask: 0x40000000; 1 = diagonal line from top left to right bottom
					$diagonalDown = (0x40000000 & self::_GetInt4d($recordData, 10)) >> 30 ?
						true : false;

					// bit: 31; mask: 0x80000000; 1 = diagonal line from bottom left to top right
					$diagonalUp = (0x80000000 & self::_GetInt4d($recordData, 10)) >> 31 ?
						true : false;

					if ($diagonalUp == false && $diagonalDown == false) {
						$objStyle->getBorders()->setDiagonalDirection(PHPExcel_Style_Borders::DIAGONAL_NONE);
					} elseif ($diagonalUp == true && $diagonalDown == false) {
						$objStyle->getBorders()->setDiagonalDirection(PHPExcel_Style_Borders::DIAGONAL_UP);
					} elseif ($diagonalUp == false && $diagonalDown == true) {
						$objStyle->getBorders()->setDiagonalDirection(PHPExcel_Style_Borders::DIAGONAL_DOWN);
					} elseif ($diagonalUp == true && $diagonalDown == true) {
						$objStyle->getBorders()->setDiagonalDirection(PHPExcel_Style_Borders::DIAGONAL_BOTH);
					}

				// offset: 14; size: 4;
					// bit: 6-0; mask: 0x0000007F; top color
					$objStyle->getBorders()->getTop()->colorIndex = (0x0000007F & self::_GetInt4d($recordData, 14)) >> 0;

					// bit: 13-7; mask: 0x00003F80; bottom color
					$objStyle->getBorders()->getBottom()->colorIndex = (0x00003F80 & self::_GetInt4d($recordData, 14)) >> 7;

					// bit: 20-14; mask: 0x001FC000; diagonal color
					$objStyle->getBorders()->getDiagonal()->colorIndex = (0x001FC000 & self::_GetInt4d($recordData, 14)) >> 14;

					// bit: 24-21; mask: 0x01E00000; diagonal style
					if ($bordersDiagonalStyle = self::_mapBorderStyle((0x01E00000 & self::_GetInt4d($recordData, 14)) >> 21)) {
						$objStyle->getBorders()->getDiagonal()->setBorderStyle($bordersDiagonalStyle);
					}

					// bit: 31-26; mask: 0xFC000000 fill pattern
					if ($fillType = self::_mapFillPattern((0xFC000000 & self::_GetInt4d($recordData, 14)) >> 26)) {
						$objStyle->getFill()->setFillType($fillType);
					}
				// offset: 18; size: 2; pattern and background colour
					// bit: 6-0; mask: 0x007F; color index for pattern color
					$objStyle->getFill()->startcolorIndex = (0x007F & self::_GetInt2d($recordData, 18)) >> 0;

					// bit: 13-7; mask: 0x3F80; color index for pattern background
					$objStyle->getFill()->endcolorIndex = (0x3F80 & self::_GetInt2d($recordData, 18)) >> 7;
			} else {
				// BIFF5

				// offset: 7; size: 1; Text orientation and flags
				$orientationAndFlags = ord($recordData{7});

				// bit: 1-0; mask: 0x03; XF_ORIENTATION: Text orientation
				$xfOrientation = (0x03 & $orientationAndFlags) >> 0;
				switch ($xfOrientation) {
					case 0:
						$objStyle->getAlignment()->setTextRotation(0);
						break;
					case 1:
						$objStyle->getAlignment()->setTextRotation(-165);
						break;
					case 2:
						$objStyle->getAlignment()->setTextRotation(90);
						break;
					case 3:
						$objStyle->getAlignment()->setTextRotation(-90);
						break;
				}

				// offset: 8; size: 4; cell border lines and background area
				$borderAndBackground = self::_GetInt4d($recordData, 8);

				// bit: 6-0; mask: 0x0000007F; color index for pattern color
				$objStyle->getFill()->startcolorIndex = (0x0000007F & $borderAndBackground) >> 0;

				// bit: 13-7; mask: 0x00003F80; color index for pattern background
				$objStyle->getFill()->endcolorIndex = (0x00003F80 & $borderAndBackground) >> 7;

				// bit: 21-16; mask: 0x003F0000; fill pattern
				$objStyle->getFill()->setFillType(self::_mapFillPattern((0x003F0000 & $borderAndBackground) >> 16));

				// bit: 24-22; mask: 0x01C00000; bottom line style
				$objStyle->getBorders()->getBottom()->setBorderStyle(self::_mapBorderStyle((0x01C00000 & $borderAndBackground) >> 22));

				// bit: 31-25; mask: 0xFE000000; bottom line color
				$objStyle->getBorders()->getBottom()->colorIndex = (0xFE000000 & $borderAndBackground) >> 25;

				// offset: 12; size: 4; cell border lines
				$borderLines = self::_GetInt4d($recordData, 12);

				// bit: 2-0; mask: 0x00000007; top line style
				$objStyle->getBorders()->getTop()->setBorderStyle(self::_mapBorderStyle((0x00000007 & $borderLines) >> 0));

				// bit: 5-3; mask: 0x00000038; left line style
				$objStyle->getBorders()->getLeft()->setBorderStyle(self::_mapBorderStyle((0x00000038 & $borderLines) >> 3));

				// bit: 8-6; mask: 0x000001C0; right line style
				$objStyle->getBorders()->getRight()->setBorderStyle(self::_mapBorderStyle((0x000001C0 & $borderLines) >> 6));

				// bit: 15-9; mask: 0x0000FE00; top line color index
				$objStyle->getBorders()->getTop()->colorIndex = (0x0000FE00 & $borderLines) >> 9;

				// bit: 22-16; mask: 0x007F0000; left line color index
				$objStyle->getBorders()->getLeft()->colorIndex = (0x007F0000 & $borderLines) >> 16;

				// bit: 29-23; mask: 0x3F800000; right line color index
				$objStyle->getBorders()->getRight()->colorIndex = (0x3F800000 & $borderLines) >> 23;
			}

			// add cellStyleXf or cellXf and update mapping
			if ($isCellStyleXf) {
				// we only read one style XF record which is always the first
				if ($this->_xfIndex == 0) {
					$this->_phpExcel->addCellStyleXf($objStyle);
					$this->_mapCellStyleXfIndex[$this->_xfIndex] = 0;
				}
			} else {
				// we read all cell XF records
				$this->_phpExcel->addCellXf($objStyle);
				$this->_mapCellXfIndex[$this->_xfIndex] = count($this->_phpExcel->getCellXfCollection()) - 1;
			}

			// update XF index for when we read next record
			++$this->_xfIndex;
		}
	}


	/**
	 *
	 */
	private function _readXfExt()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; 0x087D = repeated header

			// offset: 2; size: 2

			// offset: 4; size: 8; not used

			// offset: 12; size: 2; record version

			// offset: 14; size: 2; index to XF record which this record modifies
			$ixfe = self::_GetInt2d($recordData, 14);

			// offset: 16; size: 2; not used

			// offset: 18; size: 2; number of extension properties that follow
			$cexts = self::_GetInt2d($recordData, 18);

			// start reading the actual extension data
			$offset = 20;
			while ($offset < $length) {
				// extension type
				$extType = self::_GetInt2d($recordData, $offset);

				// extension length
				$cb = self::_GetInt2d($recordData, $offset + 2);

				// extension data
				$extData = substr($recordData, $offset + 4, $cb);

				switch ($extType) {
					case 4:		// fill start color
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$fill = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getFill();
								$fill->getStartColor()->setRGB($rgb);
								unset($fill->startcolorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 5:		// fill end color
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$fill = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getFill();
								$fill->getEndColor()->setRGB($rgb);
								unset($fill->endcolorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 7:		// border color top
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$top = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getBorders()->getTop();
								$top->getColor()->setRGB($rgb);
								unset($top->colorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 8:		// border color bottom
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$bottom = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getBorders()->getBottom();
								$bottom->getColor()->setRGB($rgb);
								unset($bottom->colorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 9:		// border color left
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$left = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getBorders()->getLeft();
								$left->getColor()->setRGB($rgb);
								unset($left->colorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 10:		// border color right
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$right = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getBorders()->getRight();
								$right->getColor()->setRGB($rgb);
								unset($right->colorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 11:		// border color diagonal
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$diagonal = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getBorders()->getDiagonal();
								$diagonal->getColor()->setRGB($rgb);
								unset($diagonal->colorIndex); // normal color index does not apply, discard
							}
						}
						break;

					case 13:	// font color
						$xclfType  = self::_GetInt2d($extData, 0); // color type
						$xclrValue = substr($extData, 4, 4); // color value (value based on color type)

						if ($xclfType == 2) {
							$rgb = sprintf('%02X%02X%02X', ord($xclrValue{0}), ord($xclrValue{1}), ord($xclrValue{2}));

							// modify the relevant style property
							if ( isset($this->_mapCellXfIndex[$ixfe]) ) {
								$font = $this->_phpExcel->getCellXfByIndex($this->_mapCellXfIndex[$ixfe])->getFont();
								$font->getColor()->setRGB($rgb);
								unset($font->colorIndex); // normal color index does not apply, discard
							}
						}
						break;
				}

				$offset += $cb;
			}
		}

	}


	/**
	 * Read STYLE record
	 */
	private function _readStyle()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; index to XF record and flag for built-in style
			$ixfe = self::_GetInt2d($recordData, 0);

			// bit: 11-0; mask 0x0FFF; index to XF record
			$xfIndex = (0x0FFF & $ixfe) >> 0;

			// bit: 15; mask 0x8000; 0 = user-defined style, 1 = built-in style
			$isBuiltIn = (bool) ((0x8000 & $ixfe) >> 15);

			if ($isBuiltIn) {
				// offset: 2; size: 1; identifier for built-in style
				$builtInId = ord($recordData{2});

				switch ($builtInId) {
				case 0x00:
					// currently, we are not using this for anything
					break;

				default:
					break;
				}

			} else {
				// user-defined; not supported by PHPExcel
			}
		}
	}


	/**
	 * Read PALETTE record
	 */
	private function _readPalette()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; number of following colors
			$nm = self::_GetInt2d($recordData, 0);

			// list of RGB colors
			for ($i = 0; $i < $nm; ++$i) {
				$rgb = substr($recordData, 2 + 4 * $i, 4);
				$this->_palette[] = self::_readRGB($rgb);
			}
		}
	}


	/**
	 * SHEET
	 *
	 * This record is  located in the  Workbook Globals
	 * Substream  and represents a sheet inside the workbook.
	 * One SHEET record is written for each sheet. It stores the
	 * sheet name and a stream offset to the BOF record of the
	 * respective Sheet Substream within the Workbook Stream.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readSheet()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 4; absolute stream position of the BOF record of the sheet
		$rec_offset = self::_GetInt4d($recordData, 0);

		// offset: 4; size: 1; sheet state
		switch (ord($recordData{4})) {
			case 0x00: $sheetState = PHPExcel_Worksheet::SHEETSTATE_VISIBLE;    break;
			case 0x01: $sheetState = PHPExcel_Worksheet::SHEETSTATE_HIDDEN;     break;
			case 0x02: $sheetState = PHPExcel_Worksheet::SHEETSTATE_VERYHIDDEN; break;
			default: $sheetState = PHPExcel_Worksheet::SHEETSTATE_VISIBLE;      break;
		}

		// offset: 5; size: 1; sheet type
		$sheetType = ord($recordData{5});

		// offset: 6; size: var; sheet name
		if ($this->_version == self::XLS_BIFF8) {
			$string = self::_readUnicodeStringShort(substr($recordData, 6));
			$rec_name = $string['value'];
		} elseif ($this->_version == self::XLS_BIFF7) {
			$string = $this->_readByteStringShort(substr($recordData, 6));
			$rec_name = $string['value'];
		}

		$this->_sheets[] = array(
			'name' => $rec_name,
			'offset' => $rec_offset,
			'sheetState' => $sheetState,
			'sheetType' => $sheetType,
		);
	}


	/**
	 * Read EXTERNALBOOK record
	 */
	private function _readExternalBook()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset within record data
		$offset = 0;

		// there are 4 types of records
		if (strlen($recordData) > 4) {
			// external reference
			// offset: 0; size: 2; number of sheet names ($nm)
			$nm = self::_GetInt2d($recordData, 0);
			$offset += 2;

			// offset: 2; size: var; encoded URL without sheet name (Unicode string, 16-bit length)
			$encodedUrlString = self::_readUnicodeStringLong(substr($recordData, 2));
			$offset += $encodedUrlString['size'];

			// offset: var; size: var; list of $nm sheet names (Unicode strings, 16-bit length)
			$externalSheetNames = array();
			for ($i = 0; $i < $nm; ++$i) {
				$externalSheetNameString = self::_readUnicodeStringLong(substr($recordData, $offset));
				$externalSheetNames[] = $externalSheetNameString['value'];
				$offset += $externalSheetNameString['size'];
			}

			// store the record data
			$this->_externalBooks[] = array(
				'type' => 'external',
				'encodedUrl' => $encodedUrlString['value'],
				'externalSheetNames' => $externalSheetNames,
			);

		} elseif (substr($recordData, 2, 2) == pack('CC', 0x01, 0x04)) {
			// internal reference
			// offset: 0; size: 2; number of sheet in this document
			// offset: 2; size: 2; 0x01 0x04
			$this->_externalBooks[] = array(
				'type' => 'internal',
			);
		} elseif (substr($recordData, 0, 4) == pack('vCC', 0x0001, 0x01, 0x3A)) {
			// add-in function
			// offset: 0; size: 2; 0x0001
			$this->_externalBooks[] = array(
				'type' => 'addInFunction',
			);
		} elseif (substr($recordData, 0, 2) == pack('v', 0x0000)) {
			// DDE links, OLE links
			// offset: 0; size: 2; 0x0000
			// offset: 2; size: var; encoded source document name
			$this->_externalBooks[] = array(
				'type' => 'DDEorOLE',
			);
		}
	}


	/**
	 * Read EXTERNNAME record.
	 */
	private function _readExternName()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// external sheet references provided for named cells
		if ($this->_version == self::XLS_BIFF8) {
			// offset: 0; size: 2; options
			$options = self::_GetInt2d($recordData, 0);

			// offset: 2; size: 2;

			// offset: 4; size: 2; not used

			// offset: 6; size: var
			$nameString = self::_readUnicodeStringShort(substr($recordData, 6));

			// offset: var; size: var; formula data
			$offset = 6 + $nameString['size'];
			$formula = $this->_getFormulaFromStructure(substr($recordData, $offset));

			$this->_externalNames[] = array(
				'name' => $nameString['value'],
				'formula' => $formula,
			);
		}
	}


	/**
	 * Read EXTERNSHEET record
	 */
	private function _readExternSheet()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// external sheet references provided for named cells
		if ($this->_version == self::XLS_BIFF8) {
			// offset: 0; size: 2; number of following ref structures
			$nm = self::_GetInt2d($recordData, 0);
			for ($i = 0; $i < $nm; ++$i) {
				$this->_ref[] = array(
					// offset: 2 + 6 * $i; index to EXTERNALBOOK record
					'externalBookIndex' => self::_GetInt2d($recordData, 2 + 6 * $i),
					// offset: 4 + 6 * $i; index to first sheet in EXTERNALBOOK record
					'firstSheetIndex' => self::_GetInt2d($recordData, 4 + 6 * $i),
					// offset: 6 + 6 * $i; index to last sheet in EXTERNALBOOK record
					'lastSheetIndex' => self::_GetInt2d($recordData, 6 + 6 * $i),
				);
			}
		}
	}


	/**
	 * DEFINEDNAME
	 *
	 * This record is part of a Link Table. It contains the name
	 * and the token array of an internal defined name. Token
	 * arrays of defined names contain tokens with aberrant
	 * token classes.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readDefinedName()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_version == self::XLS_BIFF8) {
			// retrieves named cells

			// offset: 0; size: 2; option flags
			$opts = self::_GetInt2d($recordData, 0);

				// bit: 5; mask: 0x0020; 0 = user-defined name, 1 = built-in-name
				$isBuiltInName = (0x0020 & $opts) >> 5;

			// offset: 2; size: 1; keyboard shortcut

			// offset: 3; size: 1; length of the name (character count)
			$nlen = ord($recordData{3});

			// offset: 4; size: 2; size of the formula data (it can happen that this is zero)
			// note: there can also be additional data, this is not included in $flen
			$flen = self::_GetInt2d($recordData, 4);

			// offset: 8; size: 2; 0=Global name, otherwise index to sheet (1-based)
			$scope = self::_GetInt2d($recordData, 8);

			// offset: 14; size: var; Name (Unicode string without length field)
			$string = self::_readUnicodeString(substr($recordData, 14), $nlen);

			// offset: var; size: $flen; formula data
			$offset = 14 + $string['size'];
			$formulaStructure = pack('v', $flen) . substr($recordData, $offset);

			try {
				$formula = $this->_getFormulaFromStructure($formulaStructure);
			} catch (PHPExcel_Exception $e) {
				$formula = '';
			}

			$this->_definedname[] = array(
				'isBuiltInName' => $isBuiltInName,
				'name' => $string['value'],
				'formula' => $formula,
				'scope' => $scope,
			);
		}
	}


	/**
	 * Read MSODRAWINGGROUP record
	 */
	private function _readMsoDrawingGroup()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);

		// get spliced record data
		$splicedRecordData = $this->_getSplicedRecordData();
		$recordData = $splicedRecordData['recordData'];

		$this->_drawingGroupData .= $recordData;
	}


	/**
	 * SST - Shared String Table
	 *
	 * This record contains a list of all strings used anywhere
	 * in the workbook. Each string occurs only once. The
	 * workbook uses indexes into the list to reference the
	 * strings.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 **/
	private function _readSst()
	{
		// offset within (spliced) record data
		$pos = 0;

		// get spliced record data
		$splicedRecordData = $this->_getSplicedRecordData();

		$recordData = $splicedRecordData['recordData'];
		$spliceOffsets = $splicedRecordData['spliceOffsets'];

		// offset: 0; size: 4; total number of strings in the workbook
		$pos += 4;

		// offset: 4; size: 4; number of following strings ($nm)
		$nm = self::_GetInt4d($recordData, 4);
		$pos += 4;

		// loop through the Unicode strings (16-bit length)
		for ($i = 0; $i < $nm; ++$i) {

			// number of characters in the Unicode string
			$numChars = self::_GetInt2d($recordData, $pos);
			$pos += 2;

			// option flags
			$optionFlags = ord($recordData{$pos});
			++$pos;

			// bit: 0; mask: 0x01; 0 = compressed; 1 = uncompressed
			$isCompressed = (($optionFlags & 0x01) == 0) ;

			// bit: 2; mask: 0x02; 0 = ordinary; 1 = Asian phonetic
			$hasAsian = (($optionFlags & 0x04) != 0);

			// bit: 3; mask: 0x03; 0 = ordinary; 1 = Rich-Text
			$hasRichText = (($optionFlags & 0x08) != 0);

			if ($hasRichText) {
				// number of Rich-Text formatting runs
				$formattingRuns = self::_GetInt2d($recordData, $pos);
				$pos += 2;
			}

			if ($hasAsian) {
				// size of Asian phonetic setting
				$extendedRunLength = self::_GetInt4d($recordData, $pos);
				$pos += 4;
			}

			// expected byte length of character array if not split
			$len = ($isCompressed) ? $numChars : $numChars * 2;

			// look up limit position
			foreach ($spliceOffsets as $spliceOffset) {
				// it can happen that the string is empty, therefore we need
				// <= and not just <
				if ($pos <= $spliceOffset) {
					$limitpos = $spliceOffset;
					break;
				}
			}

			if ($pos + $len <= $limitpos) {
				// character array is not split between records

				$retstr = substr($recordData, $pos, $len);
				$pos += $len;

			} else {
				// character array is split between records

				// first part of character array
				$retstr = substr($recordData, $pos, $limitpos - $pos);

				$bytesRead = $limitpos - $pos;

				// remaining characters in Unicode string
				$charsLeft = $numChars - (($isCompressed) ? $bytesRead : ($bytesRead / 2));

				$pos = $limitpos;

				// keep reading the characters
				while ($charsLeft > 0) {

					// look up next limit position, in case the string span more than one continue record
					foreach ($spliceOffsets as $spliceOffset) {
						if ($pos < $spliceOffset) {
							$limitpos = $spliceOffset;
							break;
						}
					}

					// repeated option flags
					// OpenOffice.org documentation 5.21
					$option = ord($recordData{$pos});
					++$pos;

					if ($isCompressed && ($option == 0)) {
						// 1st fragment compressed
						// this fragment compressed
						$len = min($charsLeft, $limitpos - $pos);
						$retstr .= substr($recordData, $pos, $len);
						$charsLeft -= $len;
						$isCompressed = true;

					} elseif (!$isCompressed && ($option != 0)) {
						// 1st fragment uncompressed
						// this fragment uncompressed
						$len = min($charsLeft * 2, $limitpos - $pos);
						$retstr .= substr($recordData, $pos, $len);
						$charsLeft -= $len / 2;
						$isCompressed = false;

					} elseif (!$isCompressed && ($option == 0)) {
						// 1st fragment uncompressed
						// this fragment compressed
						$len = min($charsLeft, $limitpos - $pos);
						for ($j = 0; $j < $len; ++$j) {
							$retstr .= $recordData{$pos + $j} . chr(0);
						}
						$charsLeft -= $len;
						$isCompressed = false;

					} else {
						// 1st fragment compressed
						// this fragment uncompressed
						$newstr = '';
						for ($j = 0; $j < strlen($retstr); ++$j) {
							$newstr .= $retstr[$j] . chr(0);
						}
						$retstr = $newstr;
						$len = min($charsLeft * 2, $limitpos - $pos);
						$retstr .= substr($recordData, $pos, $len);
						$charsLeft -= $len / 2;
						$isCompressed = false;
					}

					$pos += $len;
				}
			}

			// convert to UTF-8
			$retstr = self::_encodeUTF16($retstr, $isCompressed);

			// read additional Rich-Text information, if any
			$fmtRuns = array();
			if ($hasRichText) {
				// list of formatting runs
				for ($j = 0; $j < $formattingRuns; ++$j) {
					// first formatted character; zero-based
					$charPos = self::_GetInt2d($recordData, $pos + $j * 4);

					// index to font record
					$fontIndex = self::_GetInt2d($recordData, $pos + 2 + $j * 4);

					$fmtRuns[] = array(
						'charPos' => $charPos,
						'fontIndex' => $fontIndex,
					);
				}
				$pos += 4 * $formattingRuns;
			}

			// read additional Asian phonetics information, if any
			if ($hasAsian) {
				// For Asian phonetic settings, we skip the extended string data
				$pos += $extendedRunLength;
			}

			// store the shared sting
			$this->_sst[] = array(
				'value' => $retstr,
				'fmtRuns' => $fmtRuns,
			);
		}

		// _getSplicedRecordData() takes care of moving current position in data stream
	}


	/**
	 * Read PRINTGRIDLINES record
	 */
	private function _readPrintGridlines()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_version == self::XLS_BIFF8 && !$this->_readDataOnly) {
			// offset: 0; size: 2; 0 = do not print sheet grid lines; 1 = print sheet gridlines
			$printGridlines = (bool) self::_GetInt2d($recordData, 0);
			$this->_phpSheet->setPrintGridlines($printGridlines);
		}
	}


	/**
	 * Read DEFAULTROWHEIGHT record
	 */
	private function _readDefaultRowHeight()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 2; option flags
		// offset: 2; size: 2; default height for unused rows, (twips 1/20 point)
		$height = self::_GetInt2d($recordData, 2);
		$this->_phpSheet->getDefaultRowDimension()->setRowHeight($height / 20);
	}


	/**
	 * Read SHEETPR record
	 */
	private function _readSheetPr()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 2

		// bit: 6; mask: 0x0040; 0 = outline buttons above outline group
		$isSummaryBelow = (0x0040 & self::_GetInt2d($recordData, 0)) >> 6;
		$this->_phpSheet->setShowSummaryBelow($isSummaryBelow);

		// bit: 7; mask: 0x0080; 0 = outline buttons left of outline group
		$isSummaryRight = (0x0080 & self::_GetInt2d($recordData, 0)) >> 7;
		$this->_phpSheet->setShowSummaryRight($isSummaryRight);

		// bit: 8; mask: 0x100; 0 = scale printout in percent, 1 = fit printout to number of pages
		// this corresponds to radio button setting in page setup dialog in Excel
		$this->_isFitToPages = (bool) ((0x0100 & self::_GetInt2d($recordData, 0)) >> 8);
	}


	/**
	 * Read HORIZONTALPAGEBREAKS record
	 */
	private function _readHorizontalPageBreaks()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_version == self::XLS_BIFF8 && !$this->_readDataOnly) {

			// offset: 0; size: 2; number of the following row index structures
			$nm = self::_GetInt2d($recordData, 0);

			// offset: 2; size: 6 * $nm; list of $nm row index structures
			for ($i = 0; $i < $nm; ++$i) {
				$r = self::_GetInt2d($recordData, 2 + 6 * $i);
				$cf = self::_GetInt2d($recordData, 2 + 6 * $i + 2);
				$cl = self::_GetInt2d($recordData, 2 + 6 * $i + 4);

				// not sure why two column indexes are necessary?
				$this->_phpSheet->setBreakByColumnAndRow($cf, $r, PHPExcel_Worksheet::BREAK_ROW);
			}
		}
	}


	/**
	 * Read VERTICALPAGEBREAKS record
	 */
	private function _readVerticalPageBreaks()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_version == self::XLS_BIFF8 && !$this->_readDataOnly) {
			// offset: 0; size: 2; number of the following column index structures
			$nm = self::_GetInt2d($recordData, 0);

			// offset: 2; size: 6 * $nm; list of $nm row index structures
			for ($i = 0; $i < $nm; ++$i) {
				$c = self::_GetInt2d($recordData, 2 + 6 * $i);
				$rf = self::_GetInt2d($recordData, 2 + 6 * $i + 2);
				$rl = self::_GetInt2d($recordData, 2 + 6 * $i + 4);

				// not sure why two row indexes are necessary?
				$this->_phpSheet->setBreakByColumnAndRow($c, $rf, PHPExcel_Worksheet::BREAK_COLUMN);
			}
		}
	}


	/**
	 * Read HEADER record
	 */
	private function _readHeader()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: var
			// realized that $recordData can be empty even when record exists
			if ($recordData) {
				if ($this->_version == self::XLS_BIFF8) {
					$string = self::_readUnicodeStringLong($recordData);
				} else {
					$string = $this->_readByteStringShort($recordData);
				}

				$this->_phpSheet->getHeaderFooter()->setOddHeader($string['value']);
				$this->_phpSheet->getHeaderFooter()->setEvenHeader($string['value']);
			}
		}
	}


	/**
	 * Read FOOTER record
	 */
	private function _readFooter()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: var
			// realized that $recordData can be empty even when record exists
			if ($recordData) {
				if ($this->_version == self::XLS_BIFF8) {
					$string = self::_readUnicodeStringLong($recordData);
				} else {
					$string = $this->_readByteStringShort($recordData);
				}
				$this->_phpSheet->getHeaderFooter()->setOddFooter($string['value']);
				$this->_phpSheet->getHeaderFooter()->setEvenFooter($string['value']);
			}
		}
	}


	/**
	 * Read HCENTER record
	 */
	private function _readHcenter()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; 0 = print sheet left aligned, 1 = print sheet centered horizontally
			$isHorizontalCentered = (bool) self::_GetInt2d($recordData, 0);

			$this->_phpSheet->getPageSetup()->setHorizontalCentered($isHorizontalCentered);
		}
	}


	/**
	 * Read VCENTER record
	 */
	private function _readVcenter()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; 0 = print sheet aligned at top page border, 1 = print sheet vertically centered
			$isVerticalCentered = (bool) self::_GetInt2d($recordData, 0);

			$this->_phpSheet->getPageSetup()->setVerticalCentered($isVerticalCentered);
		}
	}


	/**
	 * Read LEFTMARGIN record
	 */
	private function _readLeftMargin()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 8
			$this->_phpSheet->getPageMargins()->setLeft(self::_extractNumber($recordData));
		}
	}


	/**
	 * Read RIGHTMARGIN record
	 */
	private function _readRightMargin()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 8
			$this->_phpSheet->getPageMargins()->setRight(self::_extractNumber($recordData));
		}
	}


	/**
	 * Read TOPMARGIN record
	 */
	private function _readTopMargin()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 8
			$this->_phpSheet->getPageMargins()->setTop(self::_extractNumber($recordData));
		}
	}


	/**
	 * Read BOTTOMMARGIN record
	 */
	private function _readBottomMargin()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 8
			$this->_phpSheet->getPageMargins()->setBottom(self::_extractNumber($recordData));
		}
	}


	/**
	 * Read PAGESETUP record
	 */
	private function _readPageSetup()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; paper size
			$paperSize = self::_GetInt2d($recordData, 0);

			// offset: 2; size: 2; scaling factor
			$scale = self::_GetInt2d($recordData, 2);

			// offset: 6; size: 2; fit worksheet width to this number of pages, 0 = use as many as needed
			$fitToWidth = self::_GetInt2d($recordData, 6);

			// offset: 8; size: 2; fit worksheet height to this number of pages, 0 = use as many as needed
			$fitToHeight = self::_GetInt2d($recordData, 8);

			// offset: 10; size: 2; option flags

				// bit: 1; mask: 0x0002; 0=landscape, 1=portrait
				$isPortrait = (0x0002 & self::_GetInt2d($recordData, 10)) >> 1;

				// bit: 2; mask: 0x0004; 1= paper size, scaling factor, paper orient. not init
				// when this bit is set, do not use flags for those properties
				$isNotInit = (0x0004 & self::_GetInt2d($recordData, 10)) >> 2;

			if (!$isNotInit) {
				$this->_phpSheet->getPageSetup()->setPaperSize($paperSize);
				switch ($isPortrait) {
				case 0: $this->_phpSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE); break;
				case 1: $this->_phpSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT); break;
				}

				$this->_phpSheet->getPageSetup()->setScale($scale, false);
				$this->_phpSheet->getPageSetup()->setFitToPage((bool) $this->_isFitToPages);
				$this->_phpSheet->getPageSetup()->setFitToWidth($fitToWidth, false);
				$this->_phpSheet->getPageSetup()->setFitToHeight($fitToHeight, false);
			}

			// offset: 16; size: 8; header margin (IEEE 754 floating-point value)
			$marginHeader = self::_extractNumber(substr($recordData, 16, 8));
			$this->_phpSheet->getPageMargins()->setHeader($marginHeader);

			// offset: 24; size: 8; footer margin (IEEE 754 floating-point value)
			$marginFooter = self::_extractNumber(substr($recordData, 24, 8));
			$this->_phpSheet->getPageMargins()->setFooter($marginFooter);
		}
	}


	/**
	 * PROTECT - Sheet protection (BIFF2 through BIFF8)
	 *   if this record is omitted, then it also means no sheet protection
	 */
	private function _readProtect()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_readDataOnly) {
			return;
		}

		// offset: 0; size: 2;

		// bit 0, mask 0x01; 1 = sheet is protected
		$bool = (0x01 & self::_GetInt2d($recordData, 0)) >> 0;
		$this->_phpSheet->getProtection()->setSheet((bool)$bool);
	}


	/**
	 * SCENPROTECT
	 */
	private function _readScenProtect()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_readDataOnly) {
			return;
		}

		// offset: 0; size: 2;

		// bit: 0, mask 0x01; 1 = scenarios are protected
		$bool = (0x01 & self::_GetInt2d($recordData, 0)) >> 0;

		$this->_phpSheet->getProtection()->setScenarios((bool)$bool);
	}


	/**
	 * OBJECTPROTECT
	 */
	private function _readObjectProtect()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if ($this->_readDataOnly) {
			return;
		}

		// offset: 0; size: 2;

		// bit: 0, mask 0x01; 1 = objects are protected
		$bool = (0x01 & self::_GetInt2d($recordData, 0)) >> 0;

		$this->_phpSheet->getProtection()->setObjects((bool)$bool);
	}


	/**
	 * PASSWORD - Sheet protection (hashed) password (BIFF2 through BIFF8)
	 */
	private function _readPassword()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; 16-bit hash value of password
			$password = strtoupper(dechex(self::_GetInt2d($recordData, 0))); // the hashed password
			$this->_phpSheet->getProtection()->setPassword($password, true);
		}
	}


	/**
	 * Read DEFCOLWIDTH record
	 */
	private function _readDefColWidth()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		// offset: 0; size: 2; default column width
		$width = self::_GetInt2d($recordData, 0);
		if ($width != 8) {
			$this->_phpSheet->getDefaultColumnDimension()->setWidth($width);
		}
	}


	/**
	 * Read COLINFO record
	 */
	private function _readColInfo()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; index to first column in range
			$fc = self::_GetInt2d($recordData, 0); // first column index

			// offset: 2; size: 2; index to last column in range
			$lc = self::_GetInt2d($recordData, 2); // first column index

			// offset: 4; size: 2; width of the column in 1/256 of the width of the zero character
			$width = self::_GetInt2d($recordData, 4);

			// offset: 6; size: 2; index to XF record for default column formatting
			$xfIndex = self::_GetInt2d($recordData, 6);

			// offset: 8; size: 2; option flags

				// bit: 0; mask: 0x0001; 1= columns are hidden
				$isHidden = (0x0001 & self::_GetInt2d($recordData, 8)) >> 0;

				// bit: 10-8; mask: 0x0700; outline level of the columns (0 = no outline)
				$level = (0x0700 & self::_GetInt2d($recordData, 8)) >> 8;

				// bit: 12; mask: 0x1000; 1 = collapsed
				$isCollapsed = (0x1000 & self::_GetInt2d($recordData, 8)) >> 12;

			// offset: 10; size: 2; not used

			for ($i = $fc; $i <= $lc; ++$i) {
				if ($lc == 255 || $lc == 256) {
					$this->_phpSheet->getDefaultColumnDimension()->setWidth($width / 256);
					break;
				}
				$this->_phpSheet->getColumnDimensionByColumn($i)->setWidth($width / 256);
				$this->_phpSheet->getColumnDimensionByColumn($i)->setVisible(!$isHidden);
				$this->_phpSheet->getColumnDimensionByColumn($i)->setOutlineLevel($level);
				$this->_phpSheet->getColumnDimensionByColumn($i)->setCollapsed($isCollapsed);
				$this->_phpSheet->getColumnDimensionByColumn($i)->setXfIndex($this->_mapCellXfIndex[$xfIndex]);
			}
		}
	}


	/**
	 * ROW
	 *
	 * This record contains the properties of a single row in a
	 * sheet. Rows and cells in a sheet are divided into blocks
	 * of 32 rows.
	 *
	 * --	"OpenOffice.org's Documentation of the Microsoft
	 * 		Excel File Format"
	 */
	private function _readRow()
	{
		$length = self::_GetInt2d($this->_data, $this->_pos + 2);
		$recordData = substr($this->_data, $this->_pos + 4, $length);

		// move stream pointer to next record
		$this->_pos += 4 + $length;

		if (!$this->_readDataOnly) {
			// offset: 0; size: 2; index of this row
			$r = self::_GetInt2d($recordData, 0);

			// offset: 2; size: 2; index to column of the first cell which is described by a cell record

			// offset: 4; size: 2; index to column of the last cell which is described by a cell record, increased by 1

			// offset: 6; size: 2;

			// bit: 14-0; mask: 0x7FFF; height of the row, in twips = 1/20 of a point
			$height = (0x7FFF & self::_GetInt2d($recordData, 6)) >> 0;

			// bit: 15: mask: 0x8000; 0 = row has custom height; 1= row has default height
			$useDefaultHeight = (0x8000 & self::_GetInt2d($recordData, 6)) >> 15;

			if (!$useDefaultHeight) {
				$this->_phpSheet->getRowDimension($r + 1)->setRowHeight($height / 20);
			}

			// offset: 8; size: 2; not used

			// offset: 10; size: 2; not used in BIFF5-BIFF8

			// offset: 12; size: 4; option flags and default row formatting

			// bit: 2-0: mask: 0x00000007; outline level of the row
			$level = (0x00000007 & self::_GetInt4d($recordData, 12)) >> 0;
			$this->_phpSheet->getRowDimension($r + 1)->setOutlineLevel($level);

			// bit: 4; mask: 0x00000010; 1 = outline group start or ends here... and is collapsed
			$isCollapsed = (0x00000010 & self::_GetInt4d($recordData, 12)) >> 4;
			$this->_phpSheet->getRowDimension($r + 1)->setCollapsed($isCollapsed);

			// bit: 5; mask: 0x00000020; 1 = row is hidden
			$isHidden = (0x00000020 & self::_GetInt4d($recordData, 12)) >> 5;
			$this->_phpSheet->getRowDimension($r + 1)->setVisible(!$isHidden);

			// bit: 7; mask: 0x00000080; 1 = row has explicit format
			$hasExplicitFormat = (0x00000080 & self::_GetInt4d($recordData, 12)) >> 7;

			// bit: 27-16; mask: 0x0FFF0000; only applies 