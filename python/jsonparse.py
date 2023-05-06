import sys
import json

dicjson = {
    "ok":False
}

if len(sys.argv) >= 2:
    if sys.argv[1].find("@") != -1:
        with open("data.txt", "r") as file:
            content = file.read()
            dicjson["ok"] = True
            if content.find(sys.argv[1]) != -1:
                dicjson["found"] = True
            else:
                dicjson["found"] = False
    else:
        dicjson["description"] = "Invalid email address"
else:
    dicjson["description"] = "Please provide an email address"

print(json.dumps(dicjson))