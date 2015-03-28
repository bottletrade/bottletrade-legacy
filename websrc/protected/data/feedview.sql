USE zombier1_bottletrade;

CREATE OR REPLACE VIEW event AS
SELECT 'B' AS Type, CreatedTime AS Time, UserID AS OwnerID, 0 AS ReceiverID, ID AS BottleID, 0 AS TradeID
FROM   bottle
WHERE  IsActive=1 AND IsPrivate=0

UNION  ALL
SELECT 'T' AS Type, CompletedTime AS Time,
	UserOwnerID AS OwnerID,
	UserOtherID AS ReceiverID,
	0 AS BottleID,
	/* 	
		Randomize which trade we take, this is needed so we don't
		always associate trades with the user proposing the trade
	*/
	CASE 
		WHEN (TradeID % 2) = 0 THEN MAX(ID)
		WHEN (TradeID % 2) <> 0 THEN MIN(ID)
	END 
	AS TradeID
FROM usertradeinfo
WHERE  CompletedTime IS NOT NULL
GROUP BY TradeID;

CREATE OR REPLACE VIEW feed AS
SELECT
	event.Type AS EventType, event.Time AS EventTime, event.OwnerID AS EventOwnerID, event.ReceiverID AS EventReceiverID, event.TradeID, event.BottleID,
	/* bottle fields */
	bottle.UserID,
	bottle.BeerID,
    bottle.WineID,
	bottle.SpiritID,
    bottle.Quantity,
    bottle.FluidAmount, 
    bottle.BottledOnDate, 
    bottle.Description,
    bottle.PurchasePrice ,
    bottle.IsTradeable,
    bottle.IsPrivate,
    bottle.IsSearchable,
    bottle.IsActive,
    bottle.ImagePath
FROM
	event 
	LEFT JOIN bottle ON event.BottleID = bottle.ID
