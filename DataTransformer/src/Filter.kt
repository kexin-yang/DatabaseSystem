import java.io.File
import java.text.SimpleDateFormat
import kotlin.random.Random

/* Schema:
ID
Job Title
Organization
Division
Position Type
Internal Status
App Deadline
*/

fun main() {
    val jobs = mutableListOf<Job>()

    var currentJob = Job()
    File("jobs.txt").forEachLine { line ->
        if (line.startsWith("View  Shortlist Apply")) {
            val formattedString = line.removePrefix("View  Shortlist Apply\t\t");
            currentJob.ID = formattedString.substring(0, 6).toInt()
            currentJob.JobTitle = formattedString.substring(7, formattedString.length)
        } else {
            val remainingData = line.split("\t")
            currentJob.Organization = remainingData[0]
            currentJob.Division = remainingData[1]
            currentJob.PositionType = remainingData[2]
            currentJob.InternalStatus = remainingData[3]
            val randomMonth = Random.nextInt(1, 13).toString()
            val randomDate = Random.nextInt(1, 28).toString()
            val formattedMonth = if (randomMonth.length == 2) randomMonth else "0$randomMonth"
            val formattedDate = if (randomDate.length == 2) randomDate else "0$randomDate"
            val date = "2021$formattedMonth$formattedDate"
            currentJob.AppDeadline = date.toInt()
            jobs.add(currentJob)
            currentJob = Job()
        }
    }

    val companies = mutableListOf<Company>()
    val appliedList = mutableListOf<Applied>()
    val charPool : List<Char> = ('a'..'z') + ('A'..'Z') + ('0'..'9')
    jobs.forEach { job ->
        if (!companies.any { it.Organization == job.Organization }) {
//            val pwd = (1..8)
//                .map { Random.nextInt(0, charPool.size) }
//                .map(charPool::get)
//                .joinToString("")
            val pwd = "password"

            val location = listOf("Canada", "US", "Canada", "Europe", "Canada", "Canada", "US")

            companies.add(Company(job.Organization, Random.nextInt(1, 101) / 10.0F, pwd, location.random()))
        }
    }

    /*
        var ID: Int = 0, // primary key
    var JobTitle: String = "",
    var Organization: String = "",
    var Division: String = "",
    var PositionType: String = "",
    var InternalStatus: String = "",
    var AppDeadline: Int = 0,
    var Description: String = "This is an awesome job."
     */

    jobs.forEach {
        println(it.ID.toString() + "\t" + it.JobTitle + "\t" + it.Organization + "\t" + it.Division + "\t" + it.PositionType + "\t" + it.InternalStatus + "\t" + it.AppDeadline + "\t" + it.Description)
    }

//    companies.forEach {
//        println(it.Organization + "\t" + it.Rating + "\t" + it.Password + "\t" + it.Location)
//    }

    File("applicants.txt").forEachLine { line ->
        val remainingData = line.split("\t")
        val numApplied = Random.nextInt(30)
        jobs.shuffle()
        jobs.take(numApplied).forEach {
            appliedList.add(Applied(SID = remainingData[0].toInt(), JID = it.ID, AppliedDate = it.AppDeadline))
        }
    }
//    appliedList.forEach {
//        println(it.SID.toString() + "\t" + it.JID.toString() + "\t" + it.AppliedDate.toString())
//    }
}

data class Job(
    var ID: Int = 0, // primary key
    var JobTitle: String = "",
    var Organization: String = "",
    var Division: String = "",
    var PositionType: String = "",
    var InternalStatus: String = "",
    var AppDeadline: Int = 0,
    var Description: String = "This is an awesome job."
)

data class Company(
    var Organization: String = "",
    var Rating: Float = 0.0F,
    var Password: String = "",
    var Location: String = ""
//    var Password: String = "Password",
//    var Country: String = "Canada"
)

data class Applied(
    var SID: Int = 0,
    var JID: Int = 0,
    var AppliedDate: Int = 0
)

//App Status
//ID
//Job Title
//Organization
//Division
//Position Type
//Internal Status
//App Deadline