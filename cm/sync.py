from P4 import P4,P4Exception    # Import the module
p4 = P4()                        # Create the P4 instance
p4.port = "1666"
p4.user = "fred"
p4.client = "fred-ws"            # Set some environment variables
p4.password = “

import p4

  p4c = p4.P4()
  p4c.user = "Robert"
  p4c.connect()
  p4c.login(“strip320&$BHF”)

  opened = p4c.run_opened()

try:                             # Catch exceptions with try/except
  p4.connect()                   # Connect to the Perforce Server
  p4.login(“
  info = p4.run("info")          # Run "p4 info" (returns a dict)
  for key in info[0]:            # and display all key-value pairs
    print key, "=", info[0][key]
  p4.run("edit", "file.txt")     # Run "p4 edit file.txt"
  p4.disconnect()                # Disconnect from the Server
except P4Exception:
  for e in p4.errors:            # Display errors
    print e