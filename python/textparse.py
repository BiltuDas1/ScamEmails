import sys

if len(sys.argv) >= 2:
    if sys.argv[1].find("@") != -1:
        with open("data.txt", "r") as file:
            content = file.read()
            if content.find(sys.argv[1]) != -1:
                print("true")
            else:
                print("false")
    else:
        print("Invalid email address")
else:
    print("Please provide an email address")