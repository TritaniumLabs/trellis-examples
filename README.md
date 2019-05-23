# The Traceability Blockchain API for Trellis
The Traceability Blockchain API for Trellis allows the Trellis Framework to post external block hashes and optional data on the Traceability Blockchain.  Hashes, addresses, and signatures posted to the Traceability Blockchain are stored on the immutable ledger and included in the blockchain Proof of Work.  
## Authentication
Systems posting to the Traceability Blockchain must have a authentication key and a default blockchain address.  The authentication key and the default blockchain address are both 64 character values.  The Trellis service has the option of posting all transaction using a single blockchain address or creating separate blockchain addresses for each physical location or client.
The **auth_key** parameter must be provided with the authentication key and the blockchain address connected with a colon (:)<br>&nbsp;<br>
For Example: *authkey:blockchainaddress*<br>&nbsp;<br>
## Methods Supported
The Traceability Blockchain API for Trellis supports both GET and POST methods.  
## Posting Data 
The **/trellisPut** endpoint is used to post data to the Traceability Blockchain.
<table>
<tr><th>Parameter</th><th>Required</th><th>Description</th></tr>  
<tr><td>auth_key</td><td>Yes</td><td>The combination secret key and blockchain address for the entity posting the document</td></tr>
<tr><td>hash</td><td>Yes</td><td>The hash value or signature of the data posted.  This is the primary key protected and validated by the blockchain</td></tr>
<tr><td>*others*</td><td>No</td><td>Any number of optional parameters may be added. timestamp, address, view_key, and signature are reserved words and cannot be used. </td></tr>
</table>
You can additional optional data fields to the document by running the **/trellisPut** endpoint multiple times.  The system maintains all versions of the data posted and maintains an internal history of changes.
### Results
The endpoint returns a JSON object:<br>&nbsp;<br>

{<br>
"code":"0",<br>
"message":"Transaction Complete",<br>
"transactionHash":"47d31b01c787bdc6293685a6c8a0b1bd23a77fd84c9ef9f2ac0d143567f9c715",<br>
"hash":"1234567890a123456789b123456789c123456789d123456789e123456789f1234",<br>
"addresses":["31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1"],<br>
"signatures":["1234567890a123456789b123456789c123456789d123456789e123456789f1234"]<br>
}<br>
 
Any return code other than 0 is an error.  The **transactionHash** return value contains the hash value of the transaction storing the data on the Traceability Blockchain.  If
you plan to use the **/trellisTransGet** endpoint to read data directly from the transaction block, you must store this value for future reference.  
## Reading / Validating Data 
The **/trellisGet** endpoint returns the most recent value of the data posted to the blockchain including optional data.  The **/trellisTransGet** endpoint returns the blockchain 
transaction data for the record based on the blockchain transaction number. This endpoint does not return optional data. The **/trellisHistory** endpoint returns a list of transactions 
where the hash was stored.
## **/trellisGet**
The **/trellisGet** endpoint is used to read the most recent hash and optional data from the Traceability Blockchain. 
<table>
<tr><th>Parameter</th>
    <th>Required</th>
	<th>Description</th>
</tr>  
<tr>
    <td>auth_key</td>
	<td>Yes</td>
	<td>The combination secret key and blockchain address for the entity posting the document</td>
</tr>
<tr>
    <td>hash</td>
	<td>Yes</td>
	<td>The hash value or signature to be returned.  This must be a valid hash posted to the blockchain</td>
</tr>
</table>
Any results returned by this endpoint validates that that hash exists on the blockchain.

### Results
{<br>
"created_by":"31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1",<br>
"timestamp":"15586269331295",<br>
"view_key":"42e79626400a8c069bebcc1f458913624e415be80f6e3f1944a7b430eaea4c0c",<br>
"assets":[<br>
 {"id":"1234567890a123456789b123456789c123456789d123456789e123456789f1234",<br>
 "hash":"1234567890a123456789b123456789c123456789d123456789e123456789f1234",<br>
 "block":"27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9"}<br>
 ],<br>
 "hash":"1234567890a123456789b123456789c123456789d123456789e123456789f1234",<br>
 "addresses":["31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1"],<br>
 "signatures":["1234567890"],"id":"47d31b01c787bdc6293685a6c8a0b1bd23a77fd84c9ef9f2ac0d143567f9c715"<br>
 }<br>
## **/trellisTransGet**
The **/trellisTransGet** endpoint is used to validate a hash with in a specific blockchain transaction.  The hash value must exist in the specific transaction for it to 
be returned.
<table>
<tr><th>Parameter</th><th>Required</th><th>Description</th></tr>  
<tr><td>auth_key</td><td>Yes</td><td>The combination secret key and blockchain address for the entity posting the document</td></tr>
<tr><td>hash</td><td>Yes</td><td>The hash value or signature to be returned.  This must be a valid hash posted to the blockchain</td></tr>
<tr><td>block</td><td>Yes</td><td>The hash value of the block transaction where the data is location on the blockchain.</td></tr>
</table>
Since the transaction block number is specified, there is no guarantee that the record is the latest transaction for the hash.  The endpoint verifies that the 
is contained in the specified transaction by reading the transaction directly from a blockchain node bypassing any metadata stored to manage blockchain data.

### Results
The **block_data** field returns contains the data related to the hash posted to the blockchain.  The other fields returned by this endpoint include transaction data that is
related to a crypto transfer used to pay the miners for processing the block where the transaction is mined.  The record will not be returned unless the block_data->BLOCK_HASH value 
matches the hash parameter supplied.<br>&nbsp;<br>
{<br>"amount":-100100,<br>"blockIndex":359355,<br>"extra":"",<br>"fee":100,<br>"isBase":false,<br>
"paymentId":"",<br>"state":0,<br>"timestamp":1558567062,<br>
"transactionHash":"27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9",<br>
"transfers":[<br>
{<br>"address":"Tri1boxUhdA3aBscaUHHSrcjyz9EXxeYNJh8wfbZA1nhHvEEWHekqcFTHpNXC2ryrhiy6MsBX89sEHueEr5PqoFT4FkuEXghHt",<br>
"amount":100000,<br>"type":0<br>},<br>{<br>"address":"Tri1V77aY91PinSj9wrGaM2S3EmYZfSDjGgsxPfGsWrRF9ecDAtbS5iJ4sqTsXadRZ6umSqu9LM1aRRwxTn1GSRw9B7fnpjBsC",<br>
"amount":779900,<br>"type":2}<br>,{<br>"address":"Tri1V77aY91PinSj9wrGaM2S3EmYZfSDjGgsxPfGsWrRF9ecDAtbS5iJ4sqTsXadRZ6umSqu9LM1aRRwxTn1GSRw9B7fnpjBsC",<br>
"amount":-880000,<br>"type":0<br>}<br>],"unlockTime":0,<br>"block_data":<br>{"TIME_STAMP":"15585670610187",<br>
"BLOCK_HASH":"123456789a123456789b123456789c123456789d123456789e123456789f1234",<br>
"BLOCK_URL":{<br>
"a":["31a151d30363396042c3d1977a5763b18b90cb7f95192b9f06e7824c626862c1"],<br>
"s":["123456789a123456789b123456789c123456789d123456789e123456789f1234"]<br>
}<br>}<br>}<br>

## **/trellisHistory**
The **/trellisHistory** endpoint is used to return a list of blockchain transactions where a hash was posted.  The hash value must exist in at least one transaction to
be returned.
<table>
<tr><th>Parameter</th><th>Required</th><th>Description</th></tr>  
<tr><td>auth_key</td><td>Yes</td><td>The combination secret key and blockchain address for the entity posting the document</td></tr>
<tr><td>hash</td><td>Yes</td><td>The hash value or signature to be returned.  This must be a valid hash posted to the blockchain</td></tr>
</table>
The endpoint returns a list of block transaction in the order in which they were created.

## Creating Blockchain Addresses
The **/createAddress** endpoint can be used to add additional addresses to your account to separate data between clients.  The user has the option of using the 
default blockchain address for all transactions posted or using a different blockchain address for each client.

{<br>
"hash":"27b4245994aa08e837d07421f0e18e478f622e2422bc3ce475690b16d6190ee9",<br>
"history":["4cdcb0bbbc7142949a6889ab919feb81768ce72921f8eb95a2139d7ba2cb7aea"],"current_block":"4cdcb0bbbc7142949a6889ab919feb81768ce72921f8eb95a2139d7ba2cb7aea"}