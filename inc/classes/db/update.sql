-- 06122015
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `dateautoupdate` int(10) NULL;
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `customstyle` text NULL;
-- 07152015
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `infusionsoftstatus` int(11) NOT NULL DEFAULT '0';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `infusionsoftclid` varchar(100) NOT NULL DEFAULT ' ';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `infusionsoftclsec` varchar(100) NOT NULL DEFAULT ' ';
-- 07222015 req#0001 and req#0002
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `enablesysemail` int(11) NOT NULL DEFAULT '1';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `quotedisplayedtstagid` varchar(100) NOT NULL DEFAULT ' ';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `appointmentbookedtagid` varchar(100) NOT NULL DEFAULT ' ';
--07222015 req#0002
ALTER TABLE `@wpprefix@textdomain_contacts` ADD COLUMN `hasIsAccount` int(11) NOT NULL DEFAULT '0';
ALTER TABLE `@wpprefix@textdomain_contacts` ADD COLUMN `ISContact_id`  varchar(15) NULL;
ALTER TABLE `@wpprefix@textdomain_contacts` ADD COLUMN `ISContactGrps` longtext NULL;
--07242015
ALTER TABLE `@wpprefix@textdomain_contacts` ADD COLUMN `ISMarketable` int(11) NOT NULL DEFAULT '0';
--07272015
--ALTER TABLE `@wpprefix@textdomain_syssettingss` DROP COLUMN `quotedisplayedtstagid`;
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `quotedisplayedtstagid` longtext NULL;
-- 08122015
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `isDefOptIn` int(11) NOT NULL DEFAULT '1';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `FTCExplanation`  text NULL;
ALTER TABLE `@wpprefix@textdomain_contacts` ADD COLUMN `isOptIn` int(11) NOT NULL DEFAULT '1';
-- 08172015
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `gasettings` longtext NULL;
-- 08192015 Remove deleted recorads
DELETE FROM `@wpprefix@textdomain_hometypes` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_frequencies` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_startPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_bedroomPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_bathroomPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_frqPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_petPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_sqfootagePricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_servareaPricing` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_availabledates` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_surchargerates` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_additionalserv` WHERE isDelete = 1;
DELETE FROM `@wpprefix@textdomain_marketingref` WHERE isDelete = 1;
-- 08192015 Make SortOrder field unique
ALTER TABLE `@wpprefix@textdomain_hometypes` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_frequencies` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_startPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_bedroomPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_bathroomPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_frqPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_petPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_sqfootagePricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_servareaPricing` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_availabledates` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_surchargerates` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_additionalserv` ADD UNIQUE (`sortOrder`);
ALTER TABLE `@wpprefix@textdomain_marketingref` ADD UNIQUE (`sortOrder`);
-- issue #47
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `mqisfields` longtext NULL;
-- issue #8
CREATE PROCEDURE `sortorderInc` (IN tblName varchar(50), IN curr_sortorder INT)BEGIN DECLARE done INT DEFAULT FALSE;DECLARE _id, _sortOrder INT;DECLARE _uniqueid VARCHAR(10);DECLARE _NEWEND INT DEFAULT 0;DECLARE cur CURSOR FOR select id, uniqueid, sortOrder from tmptbl_incsortorder;DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;SET @GetCount = CONCAT('SELECT count(*) INTO @_count FROM ', tblName, ' where `sortOrder` >= ', curr_sortorder, ' and isDelete = 0');PREPARE stmt1 FROM @GetCount;EXECUTE stmt1;DEALLOCATE PREPARE stmt1;if (@_count > 0) then SET @CreateView = CONCAT('CREATE OR REPLACE view tmptbl_incsortorder as SELECT id,uniqueid,sortOrder FROM ', tblName, ' where `sortOrder` >= ', curr_sortorder, ' and isDelete = 0 ORDER BY sortOrder DESC');PREPARE stmt2 FROM @CreateView;EXECUTE stmt2;DEALLOCATE PREPARE stmt2;SET _NEWEND = curr_sortorder + @_count;SELECT MIN(SORTORDER), MAX(SORTORDER) INTO @MINVAL, @MAXVAL FROM tmptbl_incsortorder;IF @MINVAL > curr_sortorder AND@MAXVAL > @_count THEN GAPFIX: LOOP IF@MINVAL = curr_sortorder THEN LEAVE GAPFIX;END IF;SET@MINVAL = @MINVAL - 1;CALL sortorderDec(tblName, @MINVAL);END LOOP GAPFIX;PREPARE stmt2 FROM@CreateView;EXECUTE stmt2;DEALLOCATE PREPARE stmt2;END IF;OPEN cur;read_loop: LOOP FETCH cur INTO _id, _uniqueid, _sortOrder;IF done THEN LEAVE read_loop; END IF;IF _NEWEND > _sortOrder THEN SET@UpdateTable = CONCAT('UPDATE ', tblName, ' SET sortOrder = ', _NEWEND, ' WHERE id = ', _id);PREPARE stmt3 FROM@UpdateTable;EXECUTE stmt3;DEALLOCATE PREPARE stmt3;END IF;set _NEWEND = _NEWEND - 1;END LOOP read_loop;CLOSE cur;DROP VIEW tmptbl_incsortorder;end if;END
CREATE PROCEDURE `sortorderDec`(IN tblName varchar(50),IN curr_sortorder INT) BEGIN DECLARE done INT DEFAULT FALSE; DECLARE _id,_sortOrder INT; DECLARE _uniqueid VARCHAR(10); DECLARE cur CURSOR FOR select id,uniqueid,sortOrder from tmptbl_decsortorder; DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE; SET @GetCount =  CONCAT('SELECT count(*) INTO @_count FROM ', tblName,' where `sortOrder` >= ',curr_sortorder,' and isDelete = 0'); PREPARE stmt1 FROM @GetCount; EXECUTE stmt1; DEALLOCATE PREPARE stmt1; SET @GetDelCount =  CONCAT('SELECT count(*) INTO @_delcount FROM ', tblName,' where isDelete = 1'); PREPARE stmt11 FROM @GetDelCount; EXECUTE stmt11; DEALLOCATE PREPARE stmt11; SET @_delcount = @_delcount  * -1 ; SET @UPDATEASDEL =  CONCAT('UPDATE ', tblName,' SET sortOrder = ',@_delcount,' , isDelete = 1',' where `sortOrder` = ',curr_sortorder,' and isDelete = 0'); PREPARE stmt12 FROM @UPDATEASDEL; EXECUTE stmt12; DEALLOCATE PREPARE stmt12; if(@_count > 0 )then SET @CreateView =  CONCAT('CREATE OR REPLACE view tmptbl_decsortorder as SELECT id,uniqueid,sortOrder FROM ', tblName,' where `sortOrder` >= ',curr_sortorder,' and isDelete = 0 ORDER BY sortOrder ASC'); PREPARE stmt2 FROM @CreateView; EXECUTE stmt2; DEALLOCATE PREPARE stmt2; SET @NEWORDER = curr_sortorder; OPEN cur; read_loop: LOOP FETCH cur INTO _id,_uniqueid,_sortOrder; IF done THEN LEAVE read_loop; END IF; SET @UpdateTable = CONCAT('UPDATE ',tblName,' SET sortOrder = ',@NEWORDER,' WHERE id = ',_id); PREPARE stmt3 FROM @UpdateTable; EXECUTE stmt3; DEALLOCATE PREPARE stmt3; set @NEWORDER = @NEWORDER + 1; END LOOP read_loop; CLOSE cur; DROP VIEW tmptbl_decsortorder; end if; END
-- issue #11
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `stripeapitype` int(11) NOT NULL DEFAULT '0'; 
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `apistripetestkey` varchar(100) NOT NULL DEFAULT ' ';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `apistripetestvalue` varchar(100) NOT NULL DEFAULT ' ';
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `stripeapicharge` int(11) NOT NULL DEFAULT '0'; 
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `instexttab3`  text NULL;
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `instexttab4`  text NULL;
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `instexttab5`  text NULL;
ALTER TABLE `@wpprefix@textdomain_syssettingss` ADD COLUMN `instexttab6`  text NULL;