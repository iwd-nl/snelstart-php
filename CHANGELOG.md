# 2.0
- Renamed AuthenticatedConnection to V1Connector.
- Added the V2Connector.
- Implemented a new method to see if a SnelstartObject has been hydrated. See ``SnelstartPHP\Model\SnelstartObject``
- AuthenticatedConnection: Version bump van v1 to v2.
- VCS: Dropped the 'v' for versions.
- BC-BREAK: Added final to all classes.
- BC-BREAK: Requests now depend on ODataRequestDataInterface instead of ODataRequestData

## BC-BREAK
- All requests needs to be initialized instead of being static
- Added final to all classes
- Requests now depend on ODataRequestDataInterface instead of ODataRequestData