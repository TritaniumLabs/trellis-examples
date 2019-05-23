# The Traceability Blockchain API for Trellis
The Traceability Blockchain API for Trellis allows the Trellis Framework to post external block hashes and optional data on the Traceability Blockchain.  Hashes, addresses, and signatures posted to the Traceability Blockchain are stored on the immutable ledger and included in the blockchain Proof of Work.  
## Authentication
Systems posting to the Traceability Blockchain must have a authentication key and a default blockchain address.  The authentication key and the default blockchain address are both 64 character values.  The Trellis service has the option of posting all transaction using a single blockchain address or creating separate blockchain addresses for each physical location or client.
The **auth_key** parameter must be provided with the authentication key and the blockchain address connected with a colon (:)<br>
For Example: *1111authkey1111:2222blockchainaddress2222*<br>
