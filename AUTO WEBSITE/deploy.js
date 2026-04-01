// deploy.js
import ftp from "basic-ftp"
import fs from "fs"
import path from "path"

const FTP_HOST = "ftp.rehanacademy.net"
const FTP_USER = "rsi133@rehanacademy.net"
const FTP_PASS = "[3b^h_q_^4m3"
const FTP_PORT = 21
const REMOTE_DIR = "/public_html"   // agar alag ho to change karo
const LOCAL_DIR = "./"              // project root

const IGNORE = new Set(["node_modules", ".git", ".DS_Store"])

async function uploadDir(client, localDir, remoteDir) {
  const items = fs.readdirSync(localDir, { withFileTypes: true })
  await client.ensureDir(remoteDir)
  for (const it of items) {
    if (IGNORE.has(it.name)) continue
    const localPath = path.join(localDir, it.name)
    const remotePath = remoteDir + "/" + it.name
    if (it.isDirectory()) {
      await uploadDir(client, localPath, remotePath)
    } else {
      await client.uploadFrom(localPath, remotePath)
      console.log("Uploaded:", remotePath)
    }
  }
}

async function deploy() {
  const client = new ftp.Client()
  client.ftp.verbose = false
  try {
    console.log("Connecting to FTP...")
    await client.access({
      host: FTP_HOST,
      user: FTP_USER,
      password: FTP_PASS,
      port: FTP_PORT,
      secure: false
    })
    console.log("Connected. Uploading files...")
    await uploadDir(client, LOCAL_DIR, REMOTE_DIR)
    console.log("✅ Upload finished.")
  } catch (err) {
    console.error("❌ Deploy error:", err.message || err)
  } finally {
    client.close()
  }
}

deploy()
