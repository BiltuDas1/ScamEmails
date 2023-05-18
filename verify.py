import sys

def is_valid_email(email):
    isDomainOk = False
    isLocalOk = False
    if email.find("@") != -1 and len(email) <= 254:
        local = email.split("@")[0]
        domain = email.split("@")[1]

        # Check Domain
        if not domain == "":
            if len(domain) >= 2 or len(domain) <= 63:
                if domain.find("-") == -1:
                    if not domain.startswith("-") and not domain.endswith("-") and domain.find("..") == -1 and not domain.endswith("."):
                        if domain.find(".") != -1:
                            temp = domain.replace(".","")
                            if temp.isalnum():
                                isDomainOk = True
                else:
                    if not domain.startswith("-") and not domain.endswith("-") and domain.find("..") == -1 and not domain.endswith("."):
                        temp = domain.replace("-","")
                        if temp.find(".") != -1:
                            temp = temp.replace(".","")
                            if temp.isalnum():
                                isDomainOk = True
    
        # Check Address
        if not local == "":
            if local.find("-") == -1 and local.find("_") == -1 and local.find(".") == -1:
                if local.isalnum():
                    isLocalOk = True
            else:
                temp = local.replace("-","")
                temp = temp.replace("_","")
                temp = temp.replace(".","")
                if temp.isalnum():
                    isLocalOk = True

        # Final
        if isDomainOk and isLocalOk:
            return True
        else:
            return False

if len(sys.argv) == 2:
    if sys.argv[1] == "--help":
        print("""Parameters of {} is:
        
{} [email]
[email] - The email address to check""".format(sys.argv[0],sys.argv[0]))
    elif is_valid_email(sys.argv[1]):
        with open('data.txt', 'r') as text:
            str = text.read()
            if str.find(sys.argv[1]) != -1:
                print(f"{sys.argv[1]} found into list")
            else:
                print(f"{sys.argv[1]} isn't found into list")
        exit(0)
    else:
        print("Invalid Email Address")
        exit(1)
elif len(sys.argv) > 2:
    print("This python script only can take 1 arguments, which is [email]")
    exit(1)
else:
    print("Please provide an Email Address")
    exit(1)