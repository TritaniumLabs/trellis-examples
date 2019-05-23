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
<td><td>*others*</td>No</td><td>Any number of optional parameters may be added. *timestamp, address, view_key,* and *signature* are reserved words and cannot be used. </td></tr>
</table>

