import sys

def is_valid_email(email):
    if "@" not in email:
        return False
    local_part, domain_part = email.split("@")
    if not local_part or not domain_part:
        return False
    if "." not in domain_part or domain_part.startswith("[") and domain_part.endswith("]"):
        return False
    if len(email) > 254:
        return False
    return True

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