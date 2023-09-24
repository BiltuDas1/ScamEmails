# ScamEmails
This is a list of verified scammers that I have found on the internet. Please note that I have not personally validated every single email address, so there may be some mistakes. If you find any errors, please contact me or send a pull request to help me fix them.

## Usablity
To check if an email address is on the list, then run
```
git clone https://github.com/BiltuDas1/ScamEmails
cd ScamEmails
python verify.py <email-address>
```
Replace `<email-address>` with the actual email address you want to check.

## API
If you want to implement this project into your application, you can use the provided API. The API can return results in either plain text or JSON format.

To use the API, send a POST request to the following URL with the email address and desired output format:
```
https://scam-emailapi.vercel.app/api
```

You can also send a GET request to the URL in the following format:
```
https://scam-emailapi.vercel.app/api?email=example@example.com&format=text
```
Note that the format parameter can only be set to either "text" or "json". If no format is specified, JSON will be the default.

## Examples
### Example in CURL (POST)

Here's an example of checking if "adavid244[at]yahoo[dot]com" is in the database using a POST request in cURL:
```
curl -s -X POST \
-d 'email=adavid244@yahoo.com' \
https://scam-emailapi.vercel.app/api

# Output: {"ok":true, "found":true}
```

### Example in Javascript Fetch (POST)

Here's an example of checking if "adavid244[at]yahoo[dot]com" is in the database using a POST request in Javascript Fetch:
```
const text = {
    email: 'adavid244@yahoo.com'
};

const request = fetch('https://scam-emailapi.vercel.app/api', {
        method: "POST",
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(text).toString()
    })
    .then((data) => data.json())
    .then((data) => console.log(data));

// Output: { ok: true, found: true }
```

### Example in Python requests (POST)

Here's an example of checking if "adavid244[at]yahoo[dot]com" is in the database using a POST request in Python requests:
```
import requests
import json

data = {
    'email': 'adavid244@yahoo.com'
}

response = json.loads(requests.post('https://scam-emailapi.vercel.app/api', data=data).text)

print(response)

# Output: {'ok': True, 'found': True}
```

## Contact
If you are interested then you can join into our telegram group [@techsouls0](https://telegram.me/techsouls0) or channel [@tecsouls](https://telegram.me/tecsouls)
