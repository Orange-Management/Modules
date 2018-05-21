-- CostCenter
SELECT
    ROW_ID, row_create_time, row_create_user, KST, Bezeichnung, Auslaufkennzeichen as Status
FROM FiKostenstellen

-- CostObject
SELECT 
    ROW_ID, row_create_time, row_create_user, KTR, Bezeichnung
FROM FiKostentraeger

-- Addresses
SELECT
    ROW_ID, row_create_user, row_create_time, Name1, Name2, Name3, Ort, Land, Telefon, PLZ, Strasse, Fax, Email, InternetAdresse
FROM Adressen

-- Customer
SELECT
    row_id, row_create_time, row_create_user, Kundennummer, Info, Auftragssperre, KreditLimitintern, EGUstId, BIC, IBAN, Verkaeufer, AdressId, Steuernummer
FROM Kunden

-- Supplier
SELECT
    row_id, row_create_time, row_create_user, LieferantenNummer, Info, Auftragssperre, EGUstId, BIC, IBAN, AdressId, Steuernummer
FROM Lieferanten

-- Article
SELECT
    row_id, row_create_time, row_create_user, Artikelnummer, Info, Artikelbezeichnung, Artikelbezeichnung2, _Englisch1, _Englisch2, ArtikelGruppenId, Auslaufartikel as Status, Chargenverwaltung, Gewicht, BeschaffungszeitTage, EUWarengruppe
FROM Artikel

-- Outbound Invoices
SELECT
    ROW_ID, ROW_CREATE_TIME, ROW_CREATE_USER, KundenId, BelegartId, AdressId, Status, Auftragsnummer, Frachtkosten, Versandkosten, ReferenzNummer, Belegnummer, Belegdatum, RechnungsAdressId, LieferAdressId, Sachbearbeiter, Verkaeufer
FROM ArchivBelegkopf

-- Outbound Invoice Elements
SELECT
    ROW_ID, ROW_CREATE_TIME, ROW_CREATE_USER, ParentID, ArtikelId, BelegzeilenId, Belegzeilentyp, Rabatt, Einzelpreis, Menge, Belegzeilentext, Steuersatz
FROM ArchivBelegzeilen

-- Stock
SELECT
    ROW_ID, row_create_time, row_create_user, ArtikelID, Charge, Lager, Seriennummer, Bestand
FROM Bestaende

-- Warehouse
SELECT
    row_id, lagernummer, lagerbezeichnung, AdressID
FROM Lagerstammdaten

-- Stock movement
SELECT
    ROW_ID, row_create_time, row_create_user, Charge, Lager, Seriennummer, Belegnummer, Menge, Uhrzeit, Bestand, ArtikelID, PlusMinus, Modus, Wert, Typ
FROM Lagerbewegungsprotokoll

-- Finance Postings
SELECT
    ROW_ID, row_create_time, row_create_user, Konto, GegenKonto, BelegNr, Buchungsdatum, Belegdatum, OPNummer, Steuerschluessel, Betrag, Nettobetrag, BuchText, JournalNr, KST, KTR, EGUstID, FremdbelegNr, StapelID, BuchungsID, KontoC, GegenkontoC, Buchungstyp
From FiBuchungsArchiv

-- Finance Accounts
SELECT
	ROW_ID, row_create_time, row_create_user, Konto, Bezeichnung, BilanzGuv, Zuordnung, Steuerart, Steuerschluesse, UVAPosition, UVAGrundlage, Saldovortrag, EGStatistik, Auslaufkonto as Status, Aktuell, KSTRechn, KTRRechn, KST, KTR, 
FROM FiSachkonten

-- Finance Batch Posting
SELECT
    ROW_ID, row_create_time, row_create_user, Buchungsdatum, Buchungsart, BelegNr, BelegDatum, Konto, Betrag, BetragSkontierf, FWBetrag, FremdBelegNr, Buchungstext, Zahlungsbedingung, SkontoTage1, SkontoProz1, SontoTage2, SkontoProz2, SontoTage3, SkontoProz3, Nettotage, EGUstID, Status 
FROM FiStapelBuchungen

-- Finance Batch
SELECT
    ROW_ID, row_create_time, row_create_user, Status, Stapeltyp, Buchungsart, Datum
FROM FiStapelInfo